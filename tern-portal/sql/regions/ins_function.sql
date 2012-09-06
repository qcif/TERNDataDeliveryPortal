CREATE OR REPLACE FUNCTION ins_function()
RETURNS TRIGGER
LANGUAGE plpgsql
AS $f$

DECLARE

  r_name_col varchar;

  l_id_val varchar;

  geom_col varchar;

BEGIN

 IF TG_NARGS != 3

    THEN

       RAISE EXCEPTION 'Trigger public.update_timestamp() called with % args',

                        TG_NARGS;

    END IF;

    r_name_col := TG_ARGV[0];

    l_id_val := TG_ARGV[1];

    geom_col := TG_ARGV[2];

 IF tg_op = 'DELETE' THEN

    EXECUTE 'DELETE FROM regions WHERE r_name = $1.' || quote_ident(r_name_col) USING OLD;

    RETURN OLD;

 END IF;

 IF tg_op = 'INSERT' THEN

    EXECUTE 'INSERT INTO regions(r_name, l_id, the_geom)'

    || 'VALUES ( $1.' || quote_ident(r_name_col) || ',' || quote_literal(l_id_val) || ', $1.' || quote_ident(geom_col) || ')' USING NEW;

    RETURN NEW;

 END IF;

 IF tg_op = 'UPDATE' THEN

    EXECUTE 'UPDATE regions SET r_name = $1.'|| quote_ident(r_name_col) || ', the_geom = $1.' || quote_ident(geom_col) || ' WHERE r_name = $2.' || r_name_col USING NEW,OLD;

    RETURN NEW;

 END IF;

END;
$f$;
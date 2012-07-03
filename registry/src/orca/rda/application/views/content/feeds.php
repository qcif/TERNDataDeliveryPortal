<?php
/** 
Copyright 2011 The Australian National University
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
***************************************************************************
*
**/ 
?>
<?php $this->load->view('tpl/header');?>
<?php $this->load->view('tpl/mid');?>
<div class="box" id="about">
<h1>Want to be notified when new collections are added to Research Data Australia?  </h1>
<p>Well you can. Research Data Australia now includes RSS, ATOM and Twitter feeds.</p>
<h2 style="text-decoration:underline;">RSS & ATOM</h2>
<p>With the almost infinite amount of information on the web, coupled with the lack of time that we have  to explore it, 
staying informed of new information is an increasingly difficult task. <a href="http://www.whatisrss.com/" target="_blank">RSS</a> and <a href="http://www.atomenabled.org/" target="_blank">ATOM</a> 
syndication feeds assist you in this task by allowing you to easily stay informed of changes to multiple websites, in a single location. The RSS and ATOM feeds within Research Data Australia are customisable;  
you can  base a feed a on a list of collections that you have generated by either searching, or browsing, within Research Data Australia. This includes searches carried out using the advanced search features 
such as the spatial map and temporal ranges. Once subscribed to a feed, you will be notified when any new collections are published to Research Data Australia which match your search/browse query.</p>

<p>To subscribe to a feed:</p>
<ol>
<li>	Conduct a search, or a browse, in Research Data Australia for collections.
<li>	In the footer of the search results you will see a link to each of the available feeds (both RSS and ATOM). Simply click on the link to your preferred format to navigate to the feed.  
(Note that the feed links are only available on the Collections tab of the search results view.)
<li>	Subscribe to the feed using a <a href="http://en.wikipedia.org/wiki/Comparison_of_feed_aggregators" target="_blank">Feed Reader</a>. 
Many feed readers will require you to copy and paste the URL of the feed into the reader subscribe to it.  
Refer to the documentation of your particular Feed Reader for more information.
</ol>
<h2 style="text-decoration:underline;">Twitter</h2>

<p><a href="https://twitter.com/about" target="_blank">Twitter</a> is an online social networking application that allows users to  share information. 
Research Data Australia is 'tweeting' new collection notifications through Twitter via @ResearchDataAU. 
Tweets will be generated on a weekly basis for any new collections published to Research Data Australia which contain <a href="http://www.abs.gov.au/%2fausstats%2fabs%40.nsf%2flookup%2f1297.0main%2bfeatures12008">Australian and New Zealand Standard Research Classification</a> Field of Research  (ANZSRC-FOR) codes. 
To follow Research Data Australia simply click <a href="https://twitter.com/researchDataAU" class="twitter-follow-button" data-show-count="false">Follow @researchDataAU</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> , 
or navigate to the <a href="https://twitter.com/#!/ResearchDataAU" target="_blank">Research Data Australia's</a> Twitter page and click the follow button shown top right.  
<em>Note that you will require a Twitter account before you can follow others on Twitter.</em></p>


<p>Not only are we tweeting about new collections but we are also grouping and tagging the notifications with ANZSRC-FOR code hashtags. 
This means that if you're using 3rd party applications like <a href="http://www.tweetdeck.com" target="_blank">TweetDeck</a>,  <a href="http://hootsuite.com" target="_blank">Hootsuite</a> or  <a href="http://monitter.com" target="_blank">Monitter</a>, 
you can filter the notification tweets from @ResearchDataAU by the ANZSRC codes you're interested in.</p>



<p>To filter the tweets in <a href="http://www.tweetdeck.com" target="_blank">TweetDeck</a>,  <a href="http://hootsuite.com" target="_blank">Hootsuite</a> or  <a href="http://monitter.com" target="_blank">Monitter</a>, 
simply add a new column/stream by conducting a search for </p>
<p><strong>#ANZSRC-&lt;code&gt; from:ResearchDataAU </strong></p>
<p>Where &lt;code&gt; is replaced with the ANZSRC code you'd like to filter by. </p>
<p>E.g. <strong>#ANZSRC010102 from:ResearchDataAU </strong></p>
<p>To find the ANZSRC code for a specific subject you can now use the <a href="http://researchdata.ands.org.au/browse" target="_blank">Research Data Australia Vocabulary Browser</a>.</p>
<h2 style="text-decoration:underline;">Support</h2>
<p><em>If you have any feedback on these services or require further assistance please contact services@ands.org.au.</em></p>

</div>
<?php $this->load->view('tpl/footer');?>
<?php if(!defined('IN_INDEX')) die('Hacking attempt'); ?><script type="text/javascript" language="javascript">
	<!--
	// Email obfuscator script 2.1 by Tim Williams, University of Arizona
	// Random encryption key feature by Andrew Moulden, Site Engineering Ltd
	// This code is freeware provided these four comment lines remain intact
	// A wizard to generate this code is at http://www.jottings.com/obfuscator/
	{ coded = "3rrXiR@XillRYrRY7SrRft.7F"
	  key = "YSgA1DIXrKR0h86m3azcnsFEjMHxLO5bqTdCUluWQB72if4ePwZyvokVp9JtGN"
	  shift=coded.length
	  link=""
	  for (i=0; i<coded.length; i++) {
		if (key.indexOf(coded.charAt(i))==-1) {
		  ltr = coded.charAt(i)
		  link += (ltr)
		}
		else {     
		  ltr = (key.indexOf(coded.charAt(i))-shift+key.length) % key.length
		  link += (key.charAt(ltr))
		}
	  }
	document.write("<a href='mailto:"+link+"'>"+link+"</a>")
	}
	//-->
</script><noscript>Sie müssen Javascript aktivieren, um die Email Adresse zu sehen.</noscript>
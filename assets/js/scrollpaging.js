jQuery.ajaxq=function(e,t){if(typeof document.ajaxq=="undefined")document.ajaxq={q:{},r:null};if(typeof document.ajaxq.q[e]=="undefined")document.ajaxq.q[e]=[];if(typeof t!="undefined"){var n={};for(var r in t)n[r]=t[r];t=n;var i=t.complete;t.complete=function(t,n){document.ajaxq.q[e].shift();document.ajaxq.r=null;if(i)i(t,n);if(document.ajaxq.q[e].length>0)document.ajaxq.r=jQuery.ajax(document.ajaxq.q[e][0])};document.ajaxq.q[e].push(t);if(document.ajaxq.q[e].length==1)document.ajaxq.r=jQuery.ajax(t)}else{if(document.ajaxq.r){document.ajaxq.r.abort();document.ajaxq.r=null}document.ajaxq.q[e]=[]}}

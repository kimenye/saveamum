/*
 * CM.JS
 * A microlibrary to help you manage cookies.
 * http://cmjs.timseverien.nl
 *
 * Tim Severien
 * http://timseverien.nl
 *
 * Copyright (c) 2013 Tim Severien
 * Released under the GPLv2 license.
 *
 */

(function(h){var d={set:function(a,c,b,e,f){a=escape(a)+"="+escape("object"===typeof c&&JSON.stringify?JSON.stringify(c):c);b&&(b.constructor===Number?a+=";max-age="+b:b.constructor===String?a+=";expires="+b:b.constructor===Date&&(a+=";expires="+b.toUTCString()));a+=";path="+(e?e:"/");f&&(a+=";domain="+f);document.cookie=a},e:function(a,c,b,e){for(var f in a)d.set(f,a[f],expires,b,e)},get:function(a){return d.a()[a]},a:function(){var a=document.cookie.split(/;\s?/i),c={},b,e;for(e in a)if(b=a[e].split("="),!(1>=b.length)){var f=c,d=unescape(b[0]),g;a:{b=unescape(b[1]);try{g=JSON.parse(b);break a}catch(h){}g=b}f[d]=g}return c},b:function(a){document.cookie=a+"=; expires="+(new Date(0)).toUTCString()},clear:function(){var a=d.a(),c;for(c in a)d.b(c)}};"function"===typeof define&&define.d?define(function(){return d}):h.c=d})(this);
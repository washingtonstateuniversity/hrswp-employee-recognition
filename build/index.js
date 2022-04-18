!function(){var e,t={35:function(e,t,r){"use strict";var n={};r.r(n),r.d(n,{metadata:function(){return v},name:function(){return m},settings:function(){return w}});var o={};r.r(o),r.d(o,{metadata:function(){return _},name:function(){return E},settings:function(){return x}});var a=window.wp.blocks,i=window.wp.element,s=window.wp.primitives,l=(0,i.createElement)(s.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,i.createElement)(s.Path,{d:"M18.3 4H9.9v-.1l-.9.2c-2.3.4-4 2.4-4 4.8s1.7 4.4 4 4.8l.7.1V20h1.5V5.5h2.9V20h1.5V5.5h2.7V4z"}));function c(){return c=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)Object.prototype.hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e},c.apply(this,arguments)}var u=r(184),p=r.n(u),d=window.wp.i18n,f=window.wp.components,h=window.wp.blockEditor,v=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"hrswp/er-award-description","title":"ER Award Description","category":"text","description":"The ER award description.","keywords":["text"],"textdomain":"default","attributes":{"align":{"type":"string"},"content":{"type":"string","source":"html","selector":"p","default":""},"placeholder":{"type":"string"},"direction":{"type":"string","enum":["ltr","rtl"]}},"supports":{"className":false,"inserter":false},"editorScript":"hrswp-employee-recognition"}');const{name:m}=v,w={icon:l,edit:function(e){let{attributes:t,mergeBlocks:r,onReplace:n,onRemove:o,setAttributes:a}=e;const{align:s,content:l,direction:u,placeholder:f}=t,v=(0,h.useBlockProps)({className:p()({[`has-text-align-${s}`]:s}),style:{direction:u}});return(0,i.createElement)(i.Fragment,null,(0,i.createElement)(h.BlockControls,{group:"block"},(0,i.createElement)(h.AlignmentControl,{value:s,onChange:e=>a({align:e})}),(0,i.createElement)("erAwardRTLControl",{direction:u,setDirection:e=>a({direction:e})})),(0,i.createElement)(h.RichText,c({identifier:"content",tagName:"p"},v,{value:l,onChange:e=>a({content:e}),onMerge:r,onReplace:n,onRemove:o,"aria-label":l?(0,d.__)("ER Award Description"):(0,d.__)("Describe the award."),"data-empty":!l,placeholder:f||(0,d.__)("Describe the award."),__unstableEmbedURLOnPaste:!0,__unstableAllowPrefixTransformations:!0})))},save:function(e){let{attributes:t}=e;const{align:r,content:n,direction:o}=t,a=p()({[`has-text-align-${r}`]:r});return(0,i.createElement)("p",h.useBlockProps.save({className:a,dir:o}),(0,i.createElement)(h.RichText.Content,{value:n}))}};var g=(0,i.createElement)(s.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},(0,i.createElement)(s.Path,{d:"M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm.5 16c0 .3-.2.5-.5.5H5c-.3 0-.5-.2-.5-.5V7h15v12zM9 10H7v2h2v-2zm0 4H7v2h2v-2zm4-4h-2v2h2v-2zm4 0h-2v2h2v-2zm-4 4h-2v2h2v-2zm4 0h-2v2h2v-2z"})),y=window.wp.data,b=window.wp.coreData,_=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"hrswp/er-award-meta-year","title":"ER Award Year","category":"widgets","description":"The length-of-service year this award belongs to.","keywords":["text"],"textdomain":"default","supports":{"html":false,"inserter":false},"editorScript":"hrswp-employee-recognition"}');const{name:E}=_,x={icon:g,edit:function(){const e=(0,h.useBlockProps)(),t=(0,y.useSelect)((e=>e("core/editor").getCurrentPostType()),[]),[r,n]=(0,b.useEntityProp)("postType",t,"meta"),o=r.hrswp_er_awards_year;return(0,i.createElement)("div",e,(0,i.createElement)(f.RadioControl,{label:"ER Award Year",selected:o,options:[{label:"All Years",value:-1},{label:"5 Years",value:5},{label:"10 Years",value:10},{label:"15 Years",value:15},{label:"20 Years",value:20},{label:"25 Years",value:25},{label:"30 Years",value:30}],onChange:e=>{n({...r,hrswp_er_awards_year:Number(e)})}}))}};[n,o].forEach((e=>{if(!e)return;const{metadata:t,settings:r,name:n}=e;(0,a.registerBlockType)(n,{...t,...r})}))},184:function(e,t){var r;!function(){"use strict";var n={}.hasOwnProperty;function o(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var a=typeof r;if("string"===a||"number"===a)e.push(r);else if(Array.isArray(r)){if(r.length){var i=o.apply(null,r);i&&e.push(i)}}else if("object"===a)if(r.toString===Object.prototype.toString)for(var s in r)n.call(r,s)&&r[s]&&e.push(s);else e.push(r.toString())}}return e.join(" ")}e.exports?(o.default=o,e.exports=o):void 0===(r=function(){return o}.apply(t,[]))||(e.exports=r)}()}},r={};function n(e){var o=r[e];if(void 0!==o)return o.exports;var a=r[e]={exports:{}};return t[e](a,a.exports,n),a.exports}n.m=t,e=[],n.O=function(t,r,o,a){if(!r){var i=1/0;for(u=0;u<e.length;u++){r=e[u][0],o=e[u][1],a=e[u][2];for(var s=!0,l=0;l<r.length;l++)(!1&a||i>=a)&&Object.keys(n.O).every((function(e){return n.O[e](r[l])}))?r.splice(l--,1):(s=!1,a<i&&(i=a));if(s){e.splice(u--,1);var c=o();void 0!==c&&(t=c)}}return t}a=a||0;for(var u=e.length;u>0&&e[u-1][2]>a;u--)e[u]=e[u-1];e[u]=[r,o,a]},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var r in t)n.o(t,r)&&!n.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){var e={826:0,431:0};n.O.j=function(t){return 0===e[t]};var t=function(t,r){var o,a,i=r[0],s=r[1],l=r[2],c=0;if(i.some((function(t){return 0!==e[t]}))){for(o in s)n.o(s,o)&&(n.m[o]=s[o]);if(l)var u=l(n)}for(t&&t(r);c<i.length;c++)a=i[c],n.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return n.O(u)},r=self.webpackChunk_washingtonstateuniversity_hrswp_employee_recognition=self.webpackChunk_washingtonstateuniversity_hrswp_employee_recognition||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))}();var o=n.O(void 0,[431],(function(){return n(35)}));o=n.O(o)}();
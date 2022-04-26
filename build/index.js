!function(){var e={184:function(e,t){var r;!function(){"use strict";var n={}.hasOwnProperty;function o(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];if(r){var a=typeof r;if("string"===a||"number"===a)e.push(r);else if(Array.isArray(r)){if(r.length){var i=o.apply(null,r);i&&e.push(i)}}else if("object"===a)if(r.toString===Object.prototype.toString)for(var l in r)n.call(r,l)&&r[l]&&e.push(l);else e.push(r.toString())}}return e.join(" ")}e.exports?(o.default=o,e.exports=o):void 0===(r=function(){return o}.apply(t,[]))||(e.exports=r)}()}},t={};function r(n){var o=t[n];if(void 0!==o)return o.exports;var a=t[n]={exports:{}};return e[n](a,a.exports,r),a.exports}r.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return r.d(t,{a:t}),t},r.d=function(e,t){for(var n in t)r.o(t,n)&&!r.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},r.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){"use strict";var e={};r.r(e),r.d(e,{metadata:function(){return _},name:function(){return b},settings:function(){return E}});var t={};r.r(t),r.d(t,{metadata:function(){return S},name:function(){return T},settings:function(){return V}});var n={};r.r(n),r.d(n,{metadata:function(){return k},name:function(){return C},settings:function(){return M}});var o={};r.r(o),r.d(o,{getOption:function(){return N}});var a={};r.r(a),r.d(a,{fetchFromAPI:function(){return I},getOption:function(){return j}});var i={};r.r(i),r.d(i,{getOption:function(){return F}});var l=window.wp.data,s=window.wp.blocks,c=window.wp.element,p=window.wp.primitives,u=(0,c.createElement)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,c.createElement)(p.Path,{d:"M12 3.2c-4.8 0-8.8 3.9-8.8 8.8 0 4.8 3.9 8.8 8.8 8.8 4.8 0 8.8-3.9 8.8-8.8 0-4.8-4-8.8-8.8-8.8zm0 16c-4 0-7.2-3.3-7.2-7.2C4.8 8 8 4.8 12 4.8s7.2 3.3 7.2 7.2c0 4-3.2 7.2-7.2 7.2zM11 17h2v-6h-2v6zm0-8h2V7h-2v2z"}));function d(){return d=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];for(var n in r)Object.prototype.hasOwnProperty.call(r,n)&&(e[n]=r[n])}return e},d.apply(this,arguments)}var h=r(184),m=r.n(h),w=window.wp.i18n,v=window.wp.components,g=window.wp.blockEditor,f=(0,c.createElement)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"-2 -2 24 24"},(0,c.createElement)(p.Path,{d:"M5.52 2h7.43c.55 0 1 .45 1 1s-.45 1-1 1h-1v13c0 .55-.45 1-1 1s-1-.45-1-1V5c0-.55-.45-1-1-1s-1 .45-1 1v12c0 .55-.45 1-1 1s-1-.45-1-1v-5.96h-.43C3.02 11.04 1 9.02 1 6.52S3.02 2 5.52 2zM14 14l5-4-5-4v8z"}));function y(e){let{direction:t,setDirection:r}=e;return(0,w.isRTL)()&&(0,c.createElement)(v.ToolbarDropdownMenu,{controls:[{icon:f,title:(0,w._x)("Left to right","editor button"),isActive:"ltr"===t,onClick(){r("ltr"===t?void 0:"ltr")}}]})}var _=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"hrswp/er-award-description","title":"ER Award Description","category":"text","description":"The ER award description.","keywords":["text"],"textdomain":"default","attributes":{"align":{"type":"string"},"content":{"type":"string","source":"html","selector":"p","default":""},"placeholder":{"type":"string"},"direction":{"type":"string","enum":["ltr","rtl"]}},"supports":{"className":false,"inserter":false},"editorScript":"hrswp-employee-recognition","editorStyle":"hrswp-employee-recognition-editor"}');const{name:b}=_,E={icon:u,edit:function(e){let{attributes:t,mergeBlocks:r,onReplace:n,onRemove:o,setAttributes:a}=e;const{align:i,content:l,direction:s,placeholder:p}=t,u=(0,g.useBlockProps)({className:m()({[`has-text-align-${i}`]:i}),style:{direction:s}});return(0,c.createElement)(c.Fragment,null,(0,c.createElement)(g.BlockControls,{group:"block"},(0,c.createElement)(g.AlignmentControl,{value:i,onChange:e=>a({align:e})}),(0,c.createElement)(y,{direction:s,setDirection:e=>a({direction:e})})),(0,c.createElement)(g.RichText,d({identifier:"content",tagName:"p"},u,{value:l,onChange:e=>a({content:e}),onMerge:r,onReplace:n,onRemove:o,"aria-label":l?(0,w.__)("ER Award Description"):(0,w.__)("Describe the award."),"data-empty":!l,placeholder:p||(0,w.__)("Describe the award."),__unstableEmbedURLOnPaste:!0,__unstableAllowPrefixTransformations:!0})))},save:function(e){let{attributes:t}=e;const{align:r,content:n,direction:o}=t,a=m()({[`has-text-align-${r}`]:r});return(0,c.createElement)("p",g.useBlockProps.save({className:a,dir:o}),(0,c.createElement)(g.RichText.Content,{value:n}))}};var x=(0,c.createElement)(p.SVG,{viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},(0,c.createElement)(p.Path,{d:"M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm.5 16c0 .3-.2.5-.5.5H5c-.3 0-.5-.2-.5-.5V7h15v12zM9 10H7v2h2v-2zm0 4H7v2h2v-2zm4-4h-2v2h2v-2zm4 0h-2v2h2v-2zm-4 4h-2v2h2v-2zm4 0h-2v2h2v-2z"})),R=window.wp.coreData;const P="hrswp/employee-recognition";var S=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"hrswp/er-award-meta-year","title":"ER Award Year","category":"widgets","description":"The length-of-service year this award belongs to.","keywords":["text"],"textdomain":"default","supports":{"html":false,"inserter":false},"editorScript":"hrswp-employee-recognition","editorStyle":"hrswp-employee-recognition-editor"}');const{name:T}=S,V={icon:x,edit:function(){const e=(0,g.useBlockProps)(),{postType:t,erAwardYearGroups:r,isRequesting:n}=(0,l.useSelect)((e=>{const{getCurrentPostType:t}=e("core/editor"),{getOption:r,isResolving:n}=e(P);return{postType:t(),erAwardYearGroups:r("hrswp_er_award_years"),isRequesting:n("getOption",["hrswp_er_award_years"])}}),[]),o=(null==r?void 0:r.length)>0?r.split(/\r?\n/).filter((e=>e)).map((e=>"-1"!==e?{label:`${e} Years`,value:Number(e)}:{label:"All Years",value:Number(e)})):[],[a,i]=(0,R.useEntityProp)("postType",t,"meta"),s=a.hrswp_er_awards_year;return(0,c.createElement)("div",e,n&&(0,c.createElement)(v.Placeholder,{icon:"admin-post",label:(0,w.__)("ER Award Year")},(0,c.createElement)(v.Spinner,null)),(0,c.createElement)(v.RadioControl,{label:"ER Award Year",selected:s,options:o,onChange:e=>{i({...a,hrswp_er_awards_year:Number(e)})}}))}};var z=(0,c.createElement)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,c.createElement)(p.Path,{fillRule:"evenodd",d:"M19.75 11H21V8.667L19.875 4H4.125L3 8.667V11h1.25v8.75h15.5V11zm-1.5 0H5.75v7.25H10V13h4v5.25h4.25V11zm-5.5-5.5h2.067l.486 3.24.028.76H12.75v-4zm-3.567 0h2.067v4H8.669l.028-.76.486-3.24zm7.615 3.1l-.464-3.1h2.36l.806 3.345V9.5h-2.668l-.034-.9zM7.666 5.5h-2.36L4.5 8.845V9.5h2.668l.034-.9.464-3.1z",clipRule:"evenodd"})),O=(0,c.createElement)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,c.createElement)(p.Path,{fillRule:"evenodd",d:"M5 5.5h14a.5.5 0 01.5.5v1.5a.5.5 0 01-.5.5H5a.5.5 0 01-.5-.5V6a.5.5 0 01.5-.5zM4 9.232A2 2 0 013 7.5V6a2 2 0 012-2h14a2 2 0 012 2v1.5a2 2 0 01-1 1.732V18a2 2 0 01-2 2H6a2 2 0 01-2-2V9.232zm1.5.268V18a.5.5 0 00.5.5h12a.5.5 0 00.5-.5V9.5h-13z",clipRule:"evenodd"})),A=(0,c.createElement)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,c.createElement)(p.Path,{d:"m21.5 9.1-6.6-6.6-4.2 5.6c-1.2-.1-2.4.1-3.6.7-.1 0-.1.1-.2.1-.5.3-.9.6-1.2.9l3.7 3.7-5.7 5.7v1.1h1.1l5.7-5.7 3.7 3.7c.4-.4.7-.8.9-1.2.1-.1.1-.2.2-.3.6-1.1.8-2.4.6-3.6l5.6-4.1zm-7.3 3.5.1.9c.1.9 0 1.8-.4 2.6l-6-6c.8-.4 1.7-.5 2.6-.4l.9.1L15 4.9 19.1 9l-4.9 3.6z"})),k=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"hrswp/er-award-inventory","title":"ER Award Inventory","category":"widgets","description":"Inventory tracking for a length-of-service award.","keywords":["text"],"textdomain":"default","attributes":{"isQuantityEditable":{"type":"boolean","default":true}},"supports":{"html":false,"inserter":false},"editorScript":"hrswp-employee-recognition"}');const{name:C}=k,M={icon:z,edit:function(e){let{attributes:t,setAttributes:r}=e;const{isQuantityEditable:n}=t,o=(0,g.useBlockProps)(),a=(0,l.useSelect)((e=>e("core/editor").getCurrentPostType()),[]),[i,s]=(0,R.useEntityProp)("postType",a,"meta"),p=i.hrswp_er_awards_quantity,u=i.hrswp_er_awards_reserve;return(0,c.createElement)(c.Fragment,null,(0,c.createElement)(g.InspectorControls,null,(0,c.createElement)(v.PanelBody,{title:(0,w.__)("Inventory Management")},(0,c.createElement)(v.ToggleControl,{label:(0,w.__)("Allow editing inventory"),checked:!!n,onChange:()=>r({isQuantityEditable:!n})}))),(0,c.createElement)("div",o,(0,c.createElement)(v.RangeControl,{label:(0,w.__)("ER Award Quantity"),help:(0,w.__)("The number of awards in inventory."),beforeIcon:O,value:p,onChange:e=>{s({...i,hrswp_er_awards_quantity:Number(e)})},min:0,max:9999,step:1,withInputField:!0,disabled:!n}),(0,c.createElement)(v.RangeControl,{label:(0,w.__)("ER Award Reserve"),help:(0,w.__)("The inventory amount at which an admin is notified."),beforeIcon:A,value:u,onChange:e=>{s({...i,hrswp_er_awards_reserve:Number(e)})},min:0,max:9999,step:1,withInputField:!0,disabled:!n,separatorType:"topFullWidth"})))}},B=[e,t,n],H={option:""};function N(e){const{option:t}=e;return t}function I(e){return{type:"FETCH_FROM_API",path:e}}function j(e){return{type:"GET_OPTION",option:e}}function*F(e){const t=`employee-recognition/v1/option/${e}`,r=yield I(t);if(r)return j(r)}var G=window.wp.apiFetch,D=r.n(G);const L={FETCH_FROM_API:function(e){return D()({path:e.path})}},Y=(0,l.createReduxStore)(P,{reducer:function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:H,t=arguments.length>1?arguments[1]:void 0;return"GET_OPTION"===t.type?{...e,option:t.option}:e},actions:a,selectors:o,controls:L,resolvers:i});(0,l.register)(Y),B.forEach((e=>{if(!e)return;const{metadata:t,settings:r,name:n}=e;(0,s.registerBlockType)(n,{...t,...r})}))}()}();
"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[107],{6262:(e,t)=>{t.A=(e,t)=>{const r=e.__vccOpts||e;for(const[e,n]of t)r[e]=n;return r}},4370:(e,t,r)=>{r.d(t,{A:()=>u});var n=r(9726),o={class:"inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"};const i={},u=(0,r(6262).A)(i,[["render",function(e,t){return(0,n.uX)(),(0,n.CE)("button",o,[(0,n.RG)(e.$slots,"default")])}]])},9607:(e,t,r)=>{r.d(t,{A:()=>u});var n=r(9726),o={class:"inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"};const i={},u=(0,r(6262).A)(i,[["render",function(e,t){return(0,n.uX)(),(0,n.CE)("button",o,[(0,n.RG)(e.$slots,"default")])}]])},7211:(e,t,r)=>{r.d(t,{A:()=>i});var n=r(9726),o=["type"];const i={__name:"SecondaryButton",props:{type:{type:String,default:"button"}},setup:function(e){return function(t,r){return(0,n.uX)(),(0,n.CE)("button",{type:e.type,class:"inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"},[(0,n.RG)(t.$slots,"default")],8,o)}}}},8107:(e,t,r)=>{r.r(t),r.d(t,{default:()=>E});var n=r(9726),o=r(9607),i=r(7211),u=r(4370);function s(e){return function(e){if(Array.isArray(e))return c(e)}(e)||function(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(e)}(e)||l(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function a(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var r=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=r){var n,o,i,u,s=[],a=!0,l=!1;try{if(i=(r=r.call(e)).next,0===t){if(Object(r)!==r)return;a=!1}else for(;!(a=(n=i.call(r)).done)&&(s.push(n.value),s.length!==t);a=!0);}catch(e){l=!0,o=e}finally{try{if(!a&&null!=r.return&&(u=r.return(),Object(u)!==u))return}finally{if(l)throw o}}return s}}(e,t)||l(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function l(e,t){if(e){if("string"==typeof e)return c(e,t);var r=Object.prototype.toString.call(e).slice(8,-1);return"Object"===r&&e.constructor&&(r=e.constructor.name),"Map"===r||"Set"===r?Array.from(e):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?c(e,t):void 0}}function c(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=new Array(t);r<t;r++)n[r]=e[r];return n}var d={class:"relative"},f=["onClick"],p=(0,n.Lk)("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24",class:"inline-block w-4 h-4 stroke-current"},[(0,n.Lk)("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"})],-1),b={class:"py-1"},m={id:"options"},y=["value"];const g={__name:"Multiselect",props:(0,n.zz)({options:Array,label:String,placeholder:String},{selected:{},selectedModifiers:{}}),emits:["update:selected"],setup:function(e){var t=e,r=(0,n.KR)(),o=a((0,n.fn)(e,"selected",{set:function(e){var r;return u.onlyname?null!==(r=null==e?void 0:e.map((function(e){return t.options.find((function(t){return t.name===e}))})))&&void 0!==r?r:[]:e},get:function(e){var t;return u.onlyname?null!==(t=null==e?void 0:e.map((function(e){return e.name})))&&void 0!==t?t:[]:null!=e?e:[]}}),2),i=o[0],u=o[1],l=function(){var e;!r.value||null!==(e=i.value)&&void 0!==e&&e.includes(r.value)||(i.value=[].concat(s(i.value),[r.value])),r.value=""};return function(t,o){return(0,n.uX)(),(0,n.CE)("div",d,[(0,n.Lk)("div",null,[(0,n.R1)(i)?((0,n.uX)(!0),(0,n.CE)(n.FK,{key:0},(0,n.pI)((0,n.R1)(i),(function(e){return(0,n.uX)(),(0,n.CE)("button",{class:"badge badge-info me-1 hover:badge-warning",onClick:function(t){return i.value=(0,n.R1)(i).filter((function(t){return t!==e}))}},[p,(0,n.eW)(" "+(0,n.v_)(e),1)],8,f)})),256)):(0,n.Q3)("",!0),(0,n.bo)((0,n.Lk)("input",{list:"options","onUpdate:modelValue":o[0]||(o[0]=function(e){return r.value=e}),class:"mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md",onChange:l},null,544),[[n.Jo,r.value]])]),(0,n.bF)(n.eB,{"enter-active-class":"transition ease-out duration-700","enter-from-class":"opacity-0 scale-95","enter-to-class":"opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"opacity-100 scale-100","leave-to-class":"opacity-0 scale-95"},{default:(0,n.k6)((function(){return[(0,n.Lk)("div",b,[(0,n.Lk)("datalist",m,[((0,n.uX)(!0),(0,n.CE)(n.FK,null,(0,n.pI)(e.options.filter((function(e){return!(0,n.R1)(i)||!(0,n.R1)(i).includes(e.name)})),(function(e){var t=e.name,r=e.id;return(0,n.uX)(),(0,n.CE)("option",{key:r,value:t},null,8,y)})),128))])])]})),_:1})])}}};function v(e){return v="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},v(e)}function k(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}function h(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?k(Object(r),!0).forEach((function(t){w(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):k(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}function w(e,t,r){var n;return n=function(e,t){if("object"!=v(e)||!e)return e;var r=e[Symbol.toPrimitive];if(void 0!==r){var n=r.call(e,t||"default");if("object"!=v(n))return n;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===t?String:Number)(e)}(t,"string"),(t="symbol"==v(n)?n:n+"")in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}var x={class:"modal-box"},S=(0,n.Lk)("caption",{class:"caption-top"},[(0,n.Lk)("h2",{class:"text-lg font-semibold text-green-800 leading-tight"},"Product")],-1),O={class:"mb-4"},j=(0,n.Lk)("label",{for:"name",class:"block text-sm font-medium text-gray-700"},"Name",-1),C=(0,n.Lk)("label",{for:"price",class:"block text-sm font-medium text-gray-700"},"Price",-1),L=(0,n.Lk)("label",{for:"qty",class:"block text-sm font-medium text-gray-700"},"Quantity",-1),A=(0,n.Lk)("label",{for:"categories",class:"block text-sm font-medium text-gray-700"},"Categories",-1);const E={__name:"Edit",props:{product:Object,categories:Array},emits:["reset-product"],setup:function(e,t){var r=t.expose,s=(t.emit,e),a=(0,n.KR)(),l=(0,n.KR)(!1),c=function(){a.value.close(),l.value=!1,s.product.reset()},d=function(){s.product.delete(route("products.delete"),{onSuccess:function(){return c()},onFinish:function(){return s.product.reset()}})};return r({showModal:function(){a.value.showModal(),l.value=!0},visible:l,close:c}),function(t,r){return(0,n.uX)(),(0,n.CE)("dialog",{class:"modal",ref_key:"dialog",ref:a,onClose:r[5]||(r[5]=function(e){return l.value=!1})},[(0,n.Lk)("div",x,[S,(0,n.Lk)("div",null,[(0,n.Lk)("form",{onSubmit:r[4]||(r[4]=(0,n.D$)((function(r){return e.product.transform((function(e){return h(h({},e),{},{price:100*e.price})})).post(t.route("products.store"),{onSuccess:function(){return c()}})}),["prevent"]))},[(0,n.Lk)("div",O,[j,(0,n.bo)((0,n.Lk)("input",{type:"text",id:"name","onUpdate:modelValue":r[0]||(r[0]=function(t){return e.product.name=t}),class:"mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"},null,512),[[n.Jo,e.product.name]]),C,(0,n.bo)((0,n.Lk)("input",{id:"price",type:"text","onUpdate:modelValue":r[1]||(r[1]=function(t){return e.product.price=t}),class:"mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"},null,512),[[n.Jo,e.product.price]]),L,(0,n.bo)((0,n.Lk)("input",{id:"qty",type:"text","onUpdate:modelValue":r[2]||(r[2]=function(t){return e.product.qty=t}),class:"mt-1 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"},null,512),[[n.Jo,e.product.qty]]),A,(0,n.bF)(g,{id:"categories",selected:e.product.categories,"onUpdate:selected":r[3]||(r[3]=function(t){return e.product.categories=t}),selectedModifiers:{onlyname:!0},options:e.categories},null,8,["selected","options"])]),(0,n.Lk)("footer",null,[(0,n.bF)(o.A,{type:"submit",class:"ms-3",disabled:e.product.processing},{default:(0,n.k6)((function(){return[(0,n.eW)(" Save ")]})),_:1},8,["disabled"]),(0,n.bF)(i.A,{class:"ms-3",onClick:c},{default:(0,n.k6)((function(){return[(0,n.eW)(" Cancel ")]})),_:1}),(0,n.bF)(u.A,{class:(0,n.C4)(["ms-3",{"opacity-25":e.product.processing}]),disabled:e.product.processing,onClick:d},{default:(0,n.k6)((function(){return[(0,n.eW)(" Delete ")]})),_:1},8,["class","disabled"])])],32)])])],544)}}}}}]);
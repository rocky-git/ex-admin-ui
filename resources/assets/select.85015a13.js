import"./vue.fe178274.js";import{n as d,o as u}from"./index.173ec6c1.js";import{b as f}from"./@vueuse.61d27e13.js";import{l as h}from"./lodash.c9cf1bdb.js";import{S as O}from"./ant-design-vue.1a08bbd0.js";import{d as b,h as g}from"./@vue.9a7efb20.js";import"./@babel.6cd0804c.js";import"./regenerator-runtime.8e24db72.js";import"./js-md5.5179c6be.js";import"./vue-router.ac7a6022.js";import"./js-cookie.31874410.js";import"./spark-md5.2cc5764b.js";import"./axios.e3200588.js";import"./@ant-design.e295b84c.js";import"./@ctrl.fa7cbd46.js";/* empty css                     */import"./dayjs.38e390ea.js";import"./clipboard.099d05c9.js";import"./markdown-it.80c3a67b.js";import"./entities.0d2c0164.js";import"./uc.micro.981ceb7b.js";import"./mdurl.ef76b4dc.js";import"./linkify-it.92c30060.js";import"./markdown-it-emoji.e3e91710.js";import"./escape-html.e5dfadb9.js";import"./prismjs.c97a8414.js";import"./diacritics.6be19c75.js";import"./markdown-it-container.512a5043.js";import"./markdown-it-anchor.c88e5394.js";import"./markdown-it-attrs.3af5ab50.js";import"./markdown-it-table-of-contents.8a4ce16f.js";import"./@kangc.75eb798b.js";import"./resize-observer-polyfill.8deb1e21.js";import"./vue-types.6e6d84ba.js";import"./dom-align.f1b5d360.js";import"./lodash-es.0ea26897.js";import"./async-validator.5d25c98b.js";import"./scroll-into-view-if-needed.5191fdbf.js";import"./compute-scroll-into-view.6058b3be.js";import"./vue-demi.819cf47c.js";var pt=b({name:"ExSelect",props:{changeLoadOptions:{type:Array,default:[]},remote:Object,options:Array},emits:["update:options"],setup(t,i){const r=h.exports.debounce(n,300),a=f(t,"options",i.emit);c();function n(o){if(t.remote){let e=t.remote;e.data.value=o,d(e).then(p=>{a.value=p.data})}}function c(){t.changeLoadOptions.forEach(o=>{l(o.params,o.updateObject,i.attrs.value)})}function l(o,e,p){o.data.value=p,d(o).then(m=>{if(m.data)for(let s in m.data)u(e,s,m.data[s])})}return{remoteOptionsDebounce:r,remoteOptions:n,options:a}},render(t){let i=Object.assign({onSearch:r=>{this.remoteOptionsDebounce(r)},onDropdownVisibleChange:r=>{r&&this.remoteOptions("")}},t.$attrs);return!t.$attrs.options&&t.options&&(i.options=t.options),g(O,i,t.$slots)}});export{pt as default};
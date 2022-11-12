var x=Object.defineProperty;var h=Object.getOwnPropertySymbols;var w=Object.prototype.hasOwnProperty,I=Object.prototype.propertyIsEnumerable;var b=(e,t,i)=>t in e?x(e,t,{enumerable:!0,configurable:!0,writable:!0,value:i}):e[t]=i,_=(e,t)=>{for(var i in t||(t={}))w.call(t,i)&&b(e,i,t[i]);if(h)for(var i of h(t))I.call(t,i)&&b(e,i,t[i]);return e};import{t as d}from"./tinymce.140b5d43.js";import{E as S}from"./@tinymce.24a850ec.js";import"./vue.db505ee4.js";import{_ as C,v as f}from"./index.d3154ee4.js";import{u as V}from"./uploader.be3447d4.js";import{c as j}from"./@vueuse.952f4739.js";import{d as E,a as N,q as T,w as z,t as A,aW as B,aR as u,at as c,au as y,H as v,aV as U,ai as $,as as F,c as O,n as q,aT as R,aS as L}from"./@vue.cb43a243.js";import"./@babel.6cd0804c.js";import"./regenerator-runtime.8e24db72.js";import"./js-md5.5179c6be.js";import"./vue-router.a08742b9.js";import"./js-cookie.31874410.js";import"./ant-design-vue.6b10f349.js";import"./@ant-design.bcfb08ae.js";import"./@ctrl.fa7cbd46.js";import"./resize-observer-polyfill.8deb1e21.js";import"./vue-types.6e6d84ba.js";import"./dom-align.f1b5d360.js";import"./lodash-es.0ea26897.js";import"./dayjs.38e390ea.js";import"./async-validator.5d25c98b.js";import"./scroll-into-view-if-needed.5191fdbf.js";import"./compute-scroll-into-view.6058b3be.js";import"./lodash.c9cf1bdb.js";import"./spark-md5.2cc5764b.js";import"./axios.e3200588.js";/* empty css                     */import"./sortablejs.412b554c.js";import"./clipboard.099d05c9.js";import"./markdown-it.80c3a67b.js";import"./entities.0d2c0164.js";import"./uc.micro.981ceb7b.js";import"./mdurl.ef76b4dc.js";import"./linkify-it.92c30060.js";import"./markdown-it-emoji.e3e91710.js";import"./escape-html.e5dfadb9.js";import"./prismjs.c97a8414.js";import"./diacritics.6be19c75.js";import"./markdown-it-container.512a5043.js";import"./markdown-it-anchor.c88e5394.js";import"./markdown-it-attrs.3af5ab50.js";import"./markdown-it-table-of-contents.8a4ce16f.js";import"./@kangc.86f7507c.js";import"./vue-demi.5fb18120.js";import"./simple-uploader.js.04c42387.js";import"./ali-oss.ce3a624c.js";import"./qiniu-js.8b174ca3.js";import"./querystring.62f12500.js";const M=E({name:"ExTinymceEditor",components:{Editor:S},props:{value:{type:String,default:""},height:{type:[String,Number],default:500},width:{type:[String,Number],default:"auto"},toolbar:{type:[String,Array],default:"bold italic underline strikethrough | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | undo redo | link unlink image axupimgs media code | removeformat fullscreen"},options:{type:[Object,Array],default:{}},tags:{type:Array,default:[]},upload:{type:[Object,Array],default:{}}},emits:["update:value"],setup(e,t){const i="/exadmin/";let l=V(e.upload);const g=j(e,"value",t.emit);N(()=>{l.uploader.cancel(),l=null});const a=T({init:{base_url:i+"tinymce",language_url:i+"tinymce/langs/zh_CN.js",language:"zh_CN",skin_url:i+"tinymce/skins/ui/oxide",content_css:i+"tinymce/skins/content/default/content.css",height:e.height,width:e.width,fontsize_formats:"10px 11px 12px 14px 16px 18px 20px 24px 36px",menubar:!1,plugins:"axupimgs advlist anchor autolink autosave code codesample directionality fullscreen hr image imagetools insertdatetime link lists media nonbreaking noneditable pagebreak preview print save searchreplace spellchecker tabfocus table template textpattern visualblocks visualchars wordcount",toolbar:e.toolbar,file_picker_types:"media",video_template_callback:o=>'<video width="'+o.width+'" height="'+o.height+'"'+(o.poster?' poster="'+o.poster+'"':"")+' controls="controls" src="'+o.source+'"></video>',file_picker_callback:(o,r,p)=>{if(p.filetype=="media"){let n=document.createElement("input");n.setAttribute("type","file"),n.onchange=function(K){let k=this.files[0];m(k,o)},n.click()}},branding:!1,convert_urls:!1,content_style:'img {max-width:100% !important } .ex-admin-tag{color:#1890ff;background:#e6f7ff;box-sizing:border-box;margin:0 8px 0 0;font-variant:tabular-nums;list-style:none;font-feature-settings:"tnum";display:inline-block;height:auto;padding:0 7px;font-size:12px;line-height:20px;white-space:nowrap;border:1px solid #91d5ff;border-radius:2px;opacity:1;transition:all .3s}',external_plugins:{powerpaste:i+"tinymce/plugins/powerpaste/plugin.min.js"},images_upload_handler:(o,r,p)=>{let n=o.blob();n=new File([n],n.name),m(n,r)}},elementId:f(),tag:f()});a.elementId=f(),Object.assign(a.init,e.options),z(()=>[e.height,e.width,e.toolbar,e.options],()=>{d.get(a.elementId)&&(d.get(a.elementId).remove(),Object.assign(a.init,{width:e.width,height:e.height,toolbar:e.toolbar,selector:"#"+a.elementId},e.options),q(()=>{d.init(a.init)}))});function m(o,r){l.uploader.addFile(o),l.watch({success:p=>{r(p)}})}function s(o){const r=d.get(a.elementId);r.execCommand("mceInsertContent",!1,'<span class="ex-admin-tag" contenteditable="false">'+o.target.innerText+"</span>"),g.value=r.getContent()}return _({value:g,insertTag:s},A(a))}}),D=e=>(R("data-v-3fc70d26"),e=e(),L(),e),H={key:0,class:"tags"},W=D(()=>y("div",null,"\u70B9\u51FB\u63D2\u5165\uFF1A",-1)),G={class:"tags-group"};function J(e,t,i,l,g,a){const m=B("editor");return u(),c(v,null,[e.tags.length>0?(u(),c("div",H,[W,y("div",G,[(u(!0),c(v,null,U(e.tags,s=>(u(),c("span",{onClick:t[0]||(t[0]=(...o)=>e.insertTag&&e.insertTag(...o)),class:"exadmin-tag"},$(s),1))),256))])])):F("",!0),O(m,{modelValue:e.value,"onUpdate:modelValue":t[1]||(t[1]=s=>e.value=s),init:e.init,id:e.elementId,"tag-name":e.tag},null,8,["modelValue","init","id","tag-name"])],64)}var He=C(M,[["render",J],["__scopeId","data-v-3fc70d26"]]);export{He as default};
import"./vue.db505ee4.js";import{b as G}from"./@vueuse.81e70e6d.js";import{S as J}from"./sortablejs.412b554c.js";import{_ as H,A as ne,h as oe,k as se,l as ue,t as R}from"./index.97cdd5f6.js";import{r as v,n as M,z as re,aW as u,aR as s,at as f,H as T,aV as Y,ah as Z,N as C,Q as U,au as c,c as n,u as k,ai as z,V as de,w as L,a as ce,ar as j,as as F,bd as b,X as Q,S as pe,R as X,af as me,aT as ve,aS as fe}from"./@vue.cb43a243.js";import{u as ge}from"./uploader.0f74b133.js";import{m as D}from"./ant-design-vue.6b10f349.js";import"./@babel.6cd0804c.js";import"./regenerator-runtime.8e24db72.js";import"./vue-demi.5fb18120.js";import"./js-md5.5179c6be.js";import"./vue-router.a08742b9.js";import"./js-cookie.31874410.js";import"./lodash.c9cf1bdb.js";import"./spark-md5.2cc5764b.js";import"./axios.e3200588.js";import"./@ant-design.bcfb08ae.js";import"./@ctrl.fa7cbd46.js";/* empty css                     */import"./dayjs.38e390ea.js";import"./clipboard.099d05c9.js";import"./markdown-it.80c3a67b.js";import"./entities.0d2c0164.js";import"./uc.micro.981ceb7b.js";import"./mdurl.ef76b4dc.js";import"./linkify-it.92c30060.js";import"./markdown-it-emoji.e3e91710.js";import"./escape-html.e5dfadb9.js";import"./prismjs.c97a8414.js";import"./diacritics.6be19c75.js";import"./markdown-it-container.512a5043.js";import"./markdown-it-anchor.c88e5394.js";import"./markdown-it-attrs.3af5ab50.js";import"./markdown-it-table-of-contents.8a4ce16f.js";import"./@kangc.86f7507c.js";import"./resize-observer-polyfill.8deb1e21.js";import"./vue-types.6e6d84ba.js";import"./dom-align.f1b5d360.js";import"./lodash-es.0ea26897.js";import"./async-validator.5d25c98b.js";import"./scroll-into-view-if-needed.5191fdbf.js";import"./compute-scroll-into-view.6058b3be.js";import"./simple-uploader.js.04c42387.js";import"./ali-oss.ce3a624c.js";import"./qiniu-js.8b174ca3.js";import"./querystring.62f12500.js";const ye=["onMouseover"],he={class:"image-tool"},_e={name:"ExImagePreview"},be=Object.assign(_e,{props:{value:Array,width:{type:Number,default:80},height:{type:Number,default:80}},emits:["update:value"],setup(e,{emit:g}){const y=G(e,"value",g),w=v(),$=v(-1);let d;M(()=>{d=J.create(w.value,{handle:".image",onEnd:l=>{const r=y.value.splice(l.oldIndex,1)[0];y.value.splice(l.newIndex,0,r)}})}),re(l=>{d&&d.destroy()});function h(l){$.value=l}function p(l){y.value.splice(l,1)}return(l,r)=>{const S=u("caret-left-outlined"),_=u("delete-outlined"),N=u("caret-right-outlined"),E=u("a-image");return s(),f("div",{class:"file-list",ref_key:"sortFileList",ref:w},[(s(!0),f(T,null,Y(k(y),(O,x)=>(s(),f("div",{class:"image",key:O,style:Z({height:e.height+"px",width:e.width+"px"}),onMouseover:m=>h(x),onMouseout:r[0]||(r[0]=m=>h(-1))},[C(c("div",he,[n(S,{onClick:m=>k(ne)(k(y),x)},null,8,["onClick"]),n(_,{onClick:m=>p(x)},null,8,["onClick"]),n(N,{onClick:m=>k(oe)(k(y),x)},null,8,["onClick"])],512),[[U,$.value==x]]),n(E,{fit:"contain",src:O,width:e.width-2,height:e.height-2,style:{"border-radius":"5%",cursor:"pointer","object-fit":"contain"}},null,8,["src","width","height"])],44,ye))),128))],512)}}});var q=H(be,[["__scopeId","data-v-3c6d63e6"]]);const ke={class:"file-item"},we=["href"],Se={class:"file-icon"},xe={class:"text"},Fe={class:"label"},$e={name:"ExFilePreview"},Be=Object.assign($e,{props:{value:Array},emits:["update:value"],setup(e,{emit:g}){const i=e,y=v(),w=G(i,"value",g);M(()=>{J.create(y.value,{handle:".file-item",onEnd:d=>{const h=w.value.splice(d.oldIndex,1)[0];w.value.splice(d.newIndex,0,h)}})});function $(d){w.value.splice(d,1)}return(d,h)=>{const p=u("a-image"),l=u("vertical-align-bottom-outlined"),r=u("delete-outlined"),S=u("check-outlined");return s(),f("div",{ref_key:"sortFileList",ref:y},[(s(!0),f(T,null,Y(k(w),(_,N)=>(s(),f("div",ke,[c("a",{class:"left",target:"_blank",href:_},[c("div",Se,[n(p,{src:k(se)(_),width:32,height:32},null,8,["src"])]),n(l,{class:"download"}),c("span",xe,z(k(ue)(_)),1)],8,we),n(r,{onClick:E=>$(N),class:"delete",style:{cursor:"pointer"}},null,8,["onClick"]),c("label",Fe,[n(S,{class:"success"})])]))),256))],512)}}});var Ie=H(Be,[["__scopeId","data-v-e661508c"]]);const ee=e=>(ve("data-v-b87900b6"),e=e(),fe(),e),Ce={class:"file-upload"},Ue=ee(()=>c("i",{class:"far fa-folder-open"},null,-1)),Ne={key:2,class:"file-list"},Pe={style:{"font-size":"12px"}},je=ee(()=>c("i",{class:"fas fa-plus"},null,-1)),ze={name:"ExUploader"},Ee=Object.assign(ze,{props:{value:[String,Array],finder:[Boolean,Object],action:String,options:{type:Object,default:{}},imageWidth:{type:Number,default:80},imageHeight:{type:Number,default:80},type:{type:String,default:"file"},params:{type:Object,default:{}},headers:{type:Object,default:{}},disk:{type:String,default:"local"},driver:{type:String,default:"local"},directory:{type:String,default:""},hideFinder:{type:Boolean,default:!1},chunk:{type:Boolean,default:!0},chunkSize:{type:Number,default:1},input:{type:Boolean,default:!1},limit:{type:Number,default:0},disabled:{type:Boolean,default:!1},multiple:{type:Boolean,default:!1},paste:{type:Boolean,default:!1},progress:{type:Boolean,default:!0},onlyShow:{type:Boolean,default:!0},isDirectory:{type:Boolean,default:!1},accept:{type:String,default:"*"},ext:{type:Array,default:[]},fileSize:{type:Number,default:0},domain:{type:String,default:""},accessKey:{type:String,default:""},secretKey:{type:String,default:""},bucket:{type:String,default:""},region:{type:String,default:""},uploadToken:String},emits:["update:value","success","error","progress","fileSubmit","addFile"],setup(e,{emit:g}){const i=e,y={x:"max-content",y:window.innerHeight/2},w=de(),$=v(),d=v(),h=v(!1),p=v(0),l=v([]),r=v(""),S=v(""),_=v(!1);L(()=>i.value,t=>{x(t)}),L(l,t=>{i.limit>0&&t.length>i.limit&&(l.value=l.value.slice(0,i.limit)),r.value=t.join("|"),i.multiple?g("update:value",t):g("update:value",r.value)},{deep:!0}),x(i.value),v();function N(t){_.value=!1}function E(t){_.value=!0}function O(t){if(_.value){t=t.originalEvent||t;let a,B,I,A,P;for(a=t.clipboardData.items,I=0,A=a.length;I<A;I++)B=a[I],!(B.kind!=="file"||!(P=B.getAsFile()))&&m.uploader.addFile(P)}}function x(t){i.multiple?l.value=t:t?l.value=[t]:l.value=[]}let m=null;L(()=>i.params,t=>{m.options.params=t}),ce(()=>{m.uploader.cancel(),m=null}),te();function te(){M(()=>{m=ge(i),m.input(d.value),m.watch({addFile:(t,a)=>{if(g("addFile",t,a),i.ext.length>0&&i.ext.indexOf(t.getExtension())===-1)return D.error("\u53EA\u5141\u8BB8\u4E0A\u4F20\u7C7B\u578B\u683C\u5F0F "+i.ext.join(",")),!1;if(i.fileSize>0&&t.size>i.fileSize)return D.error("\u4E0A\u4F20\u6587\u4EF6\u8D85\u51FA\u9650\u5236\u5927\u5C0F"+w.fileSizeText),!1},fileSubmit:t=>{if(g("fileSubmit",t),i.multiple&&i.limit>0&&t.length+l.value.length>i.limit)return D.error("\u6700\u5927\u5141\u8BB8\u4E0A\u4F20"+i.limit+"\u4E2A\u6587\u4EF6"),!1},success:t=>{g("success",t),i.multiple||(l.value=[]),l.value.push(t),p.value=0},verifyProgress:t=>{S.value="\u6821\u9A8C\u4E2D",p.value=t},progress:t=>{g("progress",t),S.value="\u4E0A\u4F20\u4E2D",p.value=t},error:t=>{g("error",t)}})})}function V(t){l.value=r.value.split("|"),l.value=l.value.filter(function(a){return a&&a.trim()})}return(t,a)=>{const B=u("a-input"),I=u("a-popover"),A=u("cloud-upload-outlined"),P=u("a-button"),W=u("a-space"),K=u("a-progress"),le=u("render"),ae=u("a-form-item-rest"),ie=u("a-modal");return s(),f("div",{class:me(["uploader",e.paste?"paste":"",e.paste&&_.value?"pasteFocus":""]),ref_key:"container",ref:$,onPaste:O,onFocus:E,onBlur:N,tabindex:"-1"},[e.type=="file"&&!e.onlyShow?(s(),j(Ie,{key:0,value:l.value,"onUpdate:value":a[0]||(a[0]=o=>l.value=o)},null,8,["value"])):F("",!0),c("div",Ce,[e.type=="image"?(s(),j(I,{key:0},{content:b(()=>[n(q,{value:l.value,"onUpdate:value":a[1]||(a[1]=o=>l.value=o)},null,8,["value"])]),default:b(()=>[e.input?(s(),j(B,{key:0,value:r.value,"onUpdate:value":a[2]||(a[2]=o=>r.value=o),disabled:e.disabled,onBlur:V,onPressEnter:V,allowClear:""},null,8,["value","disabled"])):F("",!0)]),_:1})):(s(),f(T,{key:1},[e.input?(s(),j(B,{key:0,value:r.value,"onUpdate:value":a[3]||(a[3]=o=>r.value=o),disabled:e.disabled,onBlur:V,onPressEnter:V,allowClear:""},null,8,["value","disabled"])):F("",!0)],64)),e.type=="file"||e.input?(s(),f("span",{key:2,ref_key:"element",ref:d},[Q(t.$slots,"default",{},()=>[C(n(W,null,{default:b(()=>[n(P,null,{icon:b(()=>[n(A)]),default:b(()=>[pe(" "+z(k(R)("Uploader.upload")),1)]),_:1}),!e.hideFinder&&e.finder?(s(),j(P,{key:0,onClick:a[4]||(a[4]=X(o=>h.value=!0,["stop"]))},{icon:b(()=>[Ue]),_:1})):F("",!0)]),_:1},512),[[U,e.multiple&&(e.limit==0||l.value.length<e.limit)||l.value.length==0||e.onlyShow]])],!0)],512)):F("",!0)]),(e.type=="file"||e.input)&&!e.progress?(s(),f(T,{key:1},[C(n(K,{status:"active",percent:p.value},null,8,["percent"]),[[U,p.value>0]]),C(c("div",null,z(S.value),513),[[U,p.value>0]])],64)):F("",!0),e.type=="image"&&!e.input?(s(),f("div",Ne,[n(q,{value:l.value,"onUpdate:value":a[5]||(a[5]=o=>l.value=o)},null,8,["value"]),C(c("span",{ref_key:"element",ref:d},[Q(t.$slots,"default",{},()=>[c("div",{class:"image-btn",style:Z({height:e.imageHeight+"px",width:e.imageWidth+"px"})},[C(n(K,{type:"circle",percent:p.value,width:e.imageHeight},{format:b(o=>[c("div",null,z(o)+"%",1),c("div",Pe,z(S.value),1)]),_:1},8,["percent","width"]),[[U,p.value>0]]),n(W,{direction:"vertical"},{default:b(()=>[je,!e.hideFinder&&e.finder?(s(),f("i",{key:0,class:"far fa-folder-open",onClick:a[6]||(a[6]=X(o=>h.value=!0,["stop"]))})):F("",!0)]),_:1})],4)],!0)],512),[[U,e.multiple&&(e.limit==0||l.value.length<e.limit)||l.value.length==0]])])):F("",!0),n(ie,{visible:h.value,"onUpdate:visible":a[8]||(a[8]=o=>h.value=o),width:"70%",title:k(R)("Uploader.finder"),onOk:a[9]||(a[9]=o=>h.value=!1)},{default:b(()=>[n(ae,null,{default:b(()=>[n(le,{data:e.finder,selection:l.value,"onUpdate:selection":a[7]||(a[7]=o=>l.value=o),"selection-limit":e.limit,"selection-type":e.multiple?"checkbox":"radio",scroll:y},null,8,["data","selection","selection-limit","selection-type"])]),_:1})]),_:1},8,["visible","title"])],34)}}});var It=H(Ee,[["__scopeId","data-v-b87900b6"]]);export{It as default};
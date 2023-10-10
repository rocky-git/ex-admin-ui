import"./vue.4c5758a0.js";import{d as Z}from"./@vueuse.67682d36.js";import{S as G}from"./sortablejs.412b554c.js";import{_ as H,A as ne,p as oe,q as se,r as ue,t as X}from"./index.f3b3202f.js";import{r as _,n as M,z as re,aX as u,Z as s,_ as p,u as g,H as V,aW as J,a3 as Y,N as C,Q as U,ax as m,c as n,aw as x,an as j,V as de,w as L,a as ce,$ as T,bd as w,X as q,S as pe,R as Q,a2 as me,aU as ve,aT as fe}from"./@vue.87afd1fa.js";import{u as ge}from"./uploader.ddbd902e.js";import{m as D}from"./ant-design-vue.e954adc4.js";import"./@babel.dd651e2b.js";import"./regenerator-runtime.8e24db72.js";import"./vue-demi.24ed2461.js";import"./js-md5.3cdd41c4.js";import"./vue-router.9a2c52dc.js";import"./js-cookie.31874410.js";import"./lodash.28c974ad.js";import"./spark-md5.2cc5764b.js";import"./axios.e3200588.js";import"./@ant-design.8c82b126.js";import"./@ctrl.fa7cbd46.js";/* empty css                     */import"./dayjs.0743a87f.js";import"./clipboard.89482ba1.js";import"./markdown-it.39ce48f9.js";import"./entities.0d2c0164.js";import"./uc.micro.981ceb7b.js";import"./mdurl.ef76b4dc.js";import"./linkify-it.92c30060.js";import"./markdown-it-emoji.e3e91710.js";import"./escape-html.e5dfadb9.js";import"./prismjs.169105cf.js";import"./diacritics.6be19c75.js";import"./markdown-it-container.512a5043.js";import"./markdown-it-anchor.c88e5394.js";import"./markdown-it-attrs.3af5ab50.js";import"./markdown-it-table-of-contents.8a4ce16f.js";import"./@kangc.52338b19.js";import"./resize-observer-polyfill.8deb1e21.js";import"./vue-types.6e6d84ba.js";import"./dom-align.f1b5d360.js";import"./lodash-es.0ea26897.js";import"./async-validator.5d25c98b.js";import"./scroll-into-view-if-needed.5191fdbf.js";import"./compute-scroll-into-view.6058b3be.js";import"./simple-uploader.js.c04b5c64.js";import"./ali-oss.2ae0dd0c.js";import"./qiniu-js.8b174ca3.js";import"./querystring.62f12500.js";const ye={key:0,class:"file-list"},he=["onMouseover"],_e={class:"image-tool"},be={name:"ExImagePreview"},ke=Object.assign(be,{props:{value:Array,width:{type:Number,default:80},height:{type:Number,default:80}},emits:["update:value"],setup(e,{emit:y}){const v=Z(e,"value",y),b=_(),F=_(-1);let d;M(()=>{d=G.create(b.value,{handle:".image",onEnd:l=>{const r=v.value.splice(l.oldIndex,1)[0];v.value.splice(l.newIndex,0,r)}})}),re(l=>{d&&d.destroy()});function h(l){F.value=l}function f(l){v.value.splice(l,1)}return(l,r)=>{const S=u("caret-left-outlined"),k=u("delete-outlined"),N=u("caret-right-outlined"),z=u("a-image");return s(),p("div",{ref_key:"sortFileList",ref:b},[g(v).length>0?(s(),p("div",ye,[(s(!0),p(V,null,J(g(v),(E,$)=>(s(),p("div",{class:"image",key:E,style:Y({height:e.height+"px",width:e.width+"px"}),onMouseover:c=>h($),onMouseout:r[0]||(r[0]=c=>h(-1))},[C(m("div",_e,[n(S,{onClick:c=>g(ne)(g(v),$)},null,8,["onClick"]),n(k,{onClick:c=>f($)},null,8,["onClick"]),n(N,{onClick:c=>g(oe)(g(v),$)},null,8,["onClick"])],512),[[U,F.value==$]]),n(z,{fit:"contain",src:E,width:e.width-2,height:e.height-2,style:{"border-radius":"5%",cursor:"pointer","object-fit":"contain"}},null,8,["src","width","height"])],44,he))),128))])):x("",!0)],512)}}});var R=H(ke,[["__scopeId","data-v-b0ceb154"]]);const we={class:"file-item"},xe=["href"],Se={class:"file-icon"},$e={class:"text"},Fe={class:"label"},Be={name:"ExFilePreview"},Ie=Object.assign(Be,{props:{value:Array},emits:["update:value"],setup(e,{emit:y}){const i=e,v=_(),b=Z(i,"value",y);M(()=>{G.create(v.value,{handle:".file-item",onEnd:d=>{const h=b.value.splice(d.oldIndex,1)[0];b.value.splice(d.newIndex,0,h)}})});function F(d){b.value.splice(d,1)}return(d,h)=>{const f=u("a-image"),l=u("vertical-align-bottom-outlined"),r=u("delete-outlined"),S=u("check-outlined");return s(),p("div",{ref_key:"sortFileList",ref:v},[g(b).length>0?(s(!0),p(V,{key:0},J(g(b),(k,N)=>(s(),p("div",we,[m("a",{class:"left",target:"_blank",href:k},[m("div",Se,[n(f,{src:g(se)(k),width:32,height:32},null,8,["src"])]),n(l,{class:"download"}),m("span",$e,j(g(ue)(k)),1)],8,xe),n(r,{onClick:z=>F(N),class:"delete",style:{cursor:"pointer"}},null,8,["onClick"]),m("label",Fe,[n(S,{class:"success"})])]))),256)):x("",!0)],512)}}});var Ce=H(Ie,[["__scopeId","data-v-ed7a0452"]]);const ee=e=>(ve("data-v-131b3d0f"),e=e(),fe(),e),Ue=["title"],Ne={class:"file-upload"},Pe=ee(()=>m("i",{class:"far fa-folder-open"},null,-1)),je={key:2,class:"file-list"},ze={style:{"font-size":"12px"}},Ee=ee(()=>m("i",{class:"fas fa-plus"},null,-1)),Oe={name:"ExUploader"},Ae=Object.assign(Oe,{props:{value:[String,Array],finder:[Boolean,Object],action:String,options:{type:Object,default:{}},imageWidth:{type:Number,default:80},imageHeight:{type:Number,default:80},type:{type:String,default:"file"},params:{type:Object,default:{}},headers:{type:Object,default:{}},disk:{type:String,default:"local"},driver:{type:String,default:"local"},directory:{type:String,default:""},hideFinder:{type:Boolean,default:!1},chunk:{type:Boolean,default:!0},chunkSize:{type:Number,default:1},input:{type:Boolean,default:!1},limit:{type:Number,default:0},disabled:{type:Boolean,default:!1},multiple:{type:Boolean,default:!1},paste:{type:Boolean,default:!1},progress:{type:Boolean,default:!0},saveFinder:{type:Boolean,default:!0},onlyShow:{type:Boolean,default:!0},isDirectory:{type:Boolean,default:!1},accept:{type:String,default:"*"},ext:{type:Array,default:[]},fileSize:{type:Number,default:0},domain:{type:String,default:""},accessKey:{type:String,default:""},secretKey:{type:String,default:""},bucket:{type:String,default:""},region:{type:String,default:""},uploadToken:String},emits:["update:value","success","error","progress","fileSubmit","addFile"],setup(e,{emit:y}){const i=e,v={x:"max-content",y:window.innerHeight/2},b=de(),F=_(),d=_(),h=_(!1),f=_(0),l=_([]),r=_(""),S=_(""),k=_(!1);L(()=>i.value,t=>{$(t)}),L(l,t=>{i.limit>0&&t.length>i.limit&&(l.value=l.value.slice(0,i.limit)),r.value=t.join("|"),i.multiple?y("update:value",t):y("update:value",r.value)},{deep:!0}),$(i.multiple?[...i.value]:i.value);function N(t){k.value=!1}function z(t){k.value=!0}function E(t){if(k.value){t=t.originalEvent||t;let a,B,I,A,P;for(a=t.clipboardData.items,I=0,A=a.length;I<A;I++)B=a[I],!(B.kind!=="file"||!(P=B.getAsFile()))&&c.uploader.addFile(P)}}function $(t){i.multiple?l.value=t:t?l.value=[t]:l.value=[]}let c=null;L(()=>i.params,t=>{c&&(c.options.params=t)}),ce(()=>{c.uploader.cancel(),c=null}),te();function te(){M(()=>{c=ge(i),c.input(d.value),c.watch({addFile:(t,a)=>{if(y("addFile",t,a),i.ext.length>0&&i.ext.indexOf(t.getExtension())===-1)return D.error("\u53EA\u5141\u8BB8\u4E0A\u4F20\u7C7B\u578B\u683C\u5F0F "+i.ext.join(",")),!1;if(i.fileSize>0&&t.size>i.fileSize)return D.error("\u4E0A\u4F20\u6587\u4EF6\u8D85\u51FA\u9650\u5236\u5927\u5C0F"+b.fileSizeText),!1},fileSubmit:t=>{if(y("fileSubmit",t),i.multiple&&i.limit>0&&t.length+l.value.length>i.limit)return D.error("\u6700\u5927\u5141\u8BB8\u4E0A\u4F20"+i.limit+"\u4E2A\u6587\u4EF6"),!1},success:t=>{y("success",t),i.multiple||(l.value=[]),l.value.push(t),f.value=0},verifyProgress:t=>{S.value="\u6821\u9A8C\u4E2D",f.value=t},progress:t=>{y("progress",t),S.value="\u4E0A\u4F20\u4E2D",f.value=t},error:t=>{y("error",t)}})})}function O(t){l.value=r.value.split("|"),l.value=l.value.filter(function(a){return a&&a.trim()})}return(t,a)=>{const B=u("a-input"),I=u("a-popover"),A=u("cloud-upload-outlined"),P=u("a-button"),W=u("a-space"),K=u("a-progress"),le=u("render"),ae=u("a-form-item-rest"),ie=u("a-modal");return s(),p("div",{class:me(["uploader",e.paste?"paste":"",e.paste&&k.value?"pasteFocus":""]),ref_key:"container",ref:F,title:e.paste?"\u7C98\u8D34\u4E0A\u4F20":"",onPaste:E,onFocus:z,onBlur:N,tabindex:"-1"},[e.type=="file"&&!e.onlyShow?(s(),T(Ce,{key:0,value:l.value,"onUpdate:value":a[0]||(a[0]=o=>l.value=o)},null,8,["value"])):x("",!0),m("div",Ne,[e.type=="image"&&e.input?(s(),T(I,{key:0},{content:w(()=>[n(R,{value:l.value,"onUpdate:value":a[1]||(a[1]=o=>l.value=o)},null,8,["value"])]),default:w(()=>[n(B,{value:r.value,"onUpdate:value":a[2]||(a[2]=o=>r.value=o),disabled:e.disabled,onBlur:O,onPressEnter:O,allowClear:""},null,8,["value","disabled"])]),_:1})):(s(),p(V,{key:1},[e.input?(s(),T(B,{key:0,value:r.value,"onUpdate:value":a[3]||(a[3]=o=>r.value=o),disabled:e.disabled,onBlur:O,onPressEnter:O,allowClear:""},null,8,["value","disabled"])):x("",!0)],64)),e.type=="file"||e.input?(s(),p("span",{key:2,ref_key:"element",ref:d},[q(t.$slots,"default",{},()=>[C(n(W,null,{default:w(()=>[n(P,null,{icon:w(()=>[n(A)]),default:w(()=>[pe(" "+j(g(X)("Uploader.upload")),1)]),_:1}),!e.hideFinder&&e.finder?(s(),T(P,{key:0,onClick:a[4]||(a[4]=Q(o=>h.value=!0,["stop"]))},{icon:w(()=>[Pe]),_:1})):x("",!0)]),_:1},512),[[U,e.multiple&&(e.limit==0||l.value.length<e.limit)||l.value.length==0||e.onlyShow]])],!0)],512)):x("",!0)]),(e.type=="file"||e.input)&&!e.progress?(s(),p(V,{key:1},[C(n(K,{status:"active",percent:f.value},null,8,["percent"]),[[U,f.value>0]]),C(m("div",null,j(S.value),513),[[U,f.value>0]])],64)):x("",!0),e.type=="image"&&!e.input?(s(),p("div",je,[n(R,{value:l.value,"onUpdate:value":a[5]||(a[5]=o=>l.value=o)},null,8,["value"]),C(m("span",{ref_key:"element",ref:d},[q(t.$slots,"default",{},()=>[m("div",{class:"image-btn",style:Y({height:e.imageHeight+"px",width:e.imageWidth+"px"})},[C(n(K,{type:"circle",percent:f.value,width:e.imageHeight},{format:w(o=>[m("div",null,j(o)+"%",1),m("div",ze,j(S.value),1)]),_:1},8,["percent","width"]),[[U,f.value>0]]),n(W,{direction:"vertical"},{default:w(()=>[Ee,!e.hideFinder&&e.finder?(s(),p("i",{key:0,class:"far fa-folder-open",onClick:a[6]||(a[6]=Q(o=>h.value=!0,["stop"]))})):x("",!0)]),_:1})],4)],!0)],512),[[U,e.multiple&&(e.limit==0||l.value.length<e.limit)||l.value.length==0]])])):x("",!0),n(ie,{visible:h.value,"onUpdate:visible":a[8]||(a[8]=o=>h.value=o),width:"70%",title:g(X)("Uploader.finder"),onOk:a[9]||(a[9]=o=>h.value=!1)},{default:w(()=>[n(ae,null,{default:w(()=>[n(le,{data:e.finder,selection:l.value,"onUpdate:selection":a[7]||(a[7]=o=>l.value=o),"selection-limit":e.limit,"selection-type":e.multiple?"checkbox":"radio",scroll:v},null,8,["data","selection","selection-limit","selection-type"])]),_:1})]),_:1},8,["visible","title"])],42,Ue)}}});var Ut=H(Ae,[["__scopeId","data-v-131b3d0f"]]);export{Ut as default};

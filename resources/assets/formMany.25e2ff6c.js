var K=Object.defineProperty;var V=Object.getOwnPropertySymbols;var Q=Object.prototype.hasOwnProperty,X=Object.prototype.propertyIsEnumerable;var N=(t,i,n)=>i in t?K(t,i,{enumerable:!0,configurable:!0,writable:!0,value:n}):t[i]=n,E=(t,i)=>{for(var n in i||(i={}))Q.call(i,n)&&N(t,n,i[n]);if(V)for(var n of V(i))X.call(i,n)&&N(t,n,i[n]);return t};import"./vue.fe178274.js";import{c as Y}from"./@vueuse.47cba78b.js";import{S as Z}from"./sortablejs.412b554c.js";import{_ as ee,A as P,t as d,f as j}from"./index.fbbf1a4b.js";import{r as G,n as te,a as ae,aW as f,aR as o,at as h,ar as s,bd as l,R as c,ai as m,as as u,c as v,G as H,u as e,au as oe,aV as le,W as ne,M as B,P as S}from"./@vue.9a7efb20.js";import"./@babel.6cd0804c.js";import"./regenerator-runtime.8e24db72.js";import"./vue-demi.819cf47c.js";import"./js-md5.5179c6be.js";import"./vue-router.ac7a6022.js";import"./js-cookie.31874410.js";import"./ant-design-vue.34bbe9bd.js";import"./@ant-design.e295b84c.js";import"./@ctrl.fa7cbd46.js";import"./resize-observer-polyfill.8deb1e21.js";import"./vue-types.6e6d84ba.js";import"./dom-align.f1b5d360.js";import"./lodash-es.0ea26897.js";import"./dayjs.38e390ea.js";import"./async-validator.5d25c98b.js";import"./scroll-into-view-if-needed.5191fdbf.js";import"./compute-scroll-into-view.6058b3be.js";import"./lodash.c9cf1bdb.js";import"./spark-md5.2cc5764b.js";import"./axios.e3200588.js";/* empty css                     */import"./clipboard.099d05c9.js";import"./markdown-it.80c3a67b.js";import"./entities.0d2c0164.js";import"./uc.micro.981ceb7b.js";import"./mdurl.ef76b4dc.js";import"./linkify-it.92c30060.js";import"./markdown-it-emoji.e3e91710.js";import"./escape-html.e5dfadb9.js";import"./prismjs.c97a8414.js";import"./diacritics.6be19c75.js";import"./markdown-it-container.512a5043.js";import"./markdown-it-anchor.c88e5394.js";import"./markdown-it-attrs.3af5ab50.js";import"./markdown-it-table-of-contents.8a4ce16f.js";import"./@kangc.75eb798b.js";const re={class:"hasMany"},ie={key:1},de={key:1},se={key:0,style:{"margin-top":"5px"}},ce={key:2},me={name:"ExFormMany"},ue=Object.assign(me,{props:{value:{type:Array,default:[]},limit:{type:Number,default:0},disabled:Boolean,drag:Boolean,itemData:Object,table:Boolean,field:String,title:String,columns:Array,recursion:{type:Array,default:[]}},emits:["update:value"],setup(t,{emit:i}){const n=t,C=G(-1),M=G(),a=Y(n,"value",i);a.value.forEach((r,g)=>(r.ex_admin_id=g+1,r));let F=null;n.drag&&te(()=>{let r;n.table?r=M.value.table.$el.querySelectorAll(".ant-table-content > table > tbody")[0]:r=M.value,F=Z.create(r,{animation:1e3,handle:".sortHandel",onEnd:g=>{var b=g.newIndex-1,w=g.oldIndex-1;const z=a.value.splice(w,1)[0];a.value.splice(b,0,z)}})}),ae(r=>{F&&F.destroy()});function $(){const r=E({},n.itemData);r.ex_admin_id=a.value.length+1,a.value.push(r)}function A(r){a.value.splice(r,1)}function D(){a.value.splice(0)}function O(r,g){return{onMouseenter:b=>{C.value=g},onMouseleave:b=>{C.value=-1}}}return(r,g)=>{const b=f("a-divider"),w=f("render"),z=f("caret-up-filled"),T=f("caret-down-filled"),U=f("close-circle-filled"),W=f("a-space"),q=f("drag-outlined"),L=f("a-tooltip"),J=f("a-table"),k=f("a-button"),I=f("a-form-item");return o(),h("div",re,[t.title?(o(),s(b,{key:0,orientation:"left"},{default:l(()=>[c(m(t.title),1)]),_:1})):u("",!0),t.table?(o(),h("div",ie,[v(J,{"row-key":"ex_admin_id",ref_key:"dragRef",ref:M,scroll:{x:"max-content"},"data-source":e(a),bordered:"",columns:t.columns,size:"small",class:"table",pagination:!1,"custom-row":O},{headerCell:l(({column:y})=>[v(w,{data:y.header},null,8,["data"])]),bodyCell:l(({column:y,record:p,text:x,index:_})=>[y.type=="action"?(o(),s(W,{key:0},{default:l(()=>[t.disabled?u("",!0):(o(),h(H,{key:0},[C.value==_&&e(a).length>1&&_>0?(o(),s(z,{key:0,onClick:R=>e(P)(e(a),_)},{default:l(()=>[c(m(e(d)("FormMany.up")),1)]),_:2},1032,["onClick"])):u("",!0),C.value==_&&e(a).length>1&&_<e(a).length-1?(o(),s(T,{key:1,onClick:R=>e(j)(e(a),_)},{default:l(()=>[c(m(e(d)("FormMany.down")),1)]),_:2},1032,["onClick"])):u("",!0),C.value==_&&e(a).length>0?(o(),s(U,{key:2,style:{color:"red"},type:"dashed",onClick:R=>A(_)},{default:l(()=>[c(m(e(d)("FormMany.remove")),1)]),_:2},1032,["onClick"])):u("",!0)],64))]),_:2},1024)):y.type=="sortDrag"?(o(),h("div",de,[v(L,{placement:"right",title:e(d)("Grid.sortDrag")},{default:l(()=>[v(q,{class:"sortHandel","data-field":y.dataIndex,style:{"font-weight":"bold",cursor:"grab"}},null,8,["data-field"])]),_:2},1032,["title"])])):(o(),s(w,{key:2,scopeProp:{$index:_,field:t.field,row:p,recursion:t.recursion},data:y.component},null,8,["scopeProp","data"]))]),_:1},8,["data-source","columns"]),t.disabled?u("",!0):(o(),h("div",se,[t.limit==0||t.limit>e(a).length?(o(),s(k,{key:0,size:"small",type:"dashed",onClick:$},{default:l(()=>[c(m(e(d)("FormMany.add")),1)]),_:1})):u("",!0),t.limit==0||t.limit>e(a).length?(o(),s(k,{key:1,size:"small",type:"danger",onClick:D},{default:l(()=>[c(m(e(d)("FormMany.clear")),1)]),_:1})):u("",!0)]))])):(o(),h("div",ce,[oe("div",{ref_key:"dragRef",ref:M},[(o(!0),h(H,null,le(e(a),(y,p)=>(o(),h("div",{key:y.ex_admin_id},[ne(r.$slots,"default",{$index:p,field:t.field,row:y,recursion:t.recursion},void 0,!0),t.disabled?u("",!0):(o(),s(I,{key:0,label:" ",colon:!1},{default:l(()=>[e(a).length-1==p&&(t.limit==0||t.limit>e(a).length)?(o(),s(k,{key:0,size:"small",type:"dashed",onClick:$},{default:l(()=>[c(m(e(d)("FormMany.add")),1)]),_:1})):u("",!0),B(v(k,{size:"small",type:"dashed",onClick:x=>A(p)},{default:l(()=>[c(m(e(d)("FormMany.remove")),1)]),_:2},1032,["onClick"]),[[S,e(a).length>0]]),B(v(k,{size:"small",onClick:x=>e(P)(e(a),p)},{default:l(()=>[c(m(e(d)("FormMany.up")),1)]),_:2},1032,["onClick"]),[[S,e(a).length>1&&p>0]]),B(v(k,{size:"small",onClick:x=>e(j)(e(a),p)},{default:l(()=>[c(m(e(d)("FormMany.down")),1)]),_:2},1032,["onClick"]),[[S,e(a).length>1&&p<e(a).length-1]]),e(a).length-1==p&&(t.limit==0||t.limit>e(a).length)?(o(),s(k,{key:1,size:"small",type:"dashed",onClick:D},{default:l(()=>[c(m(e(d)("FormMany.clear")),1)]),_:1})):u("",!0)]),_:2},1024)),v(b)]))),128))],512),e(a).length==0&&!t.disabled?(o(),s(I,{key:0,label:" ",colon:!1},{default:l(()=>[v(k,{size:"small",type:"dashed",onClick:$},{default:l(()=>[c(m(e(d)("FormMany.add")),1)]),_:1})]),_:1})):u("",!0)]))])}}});var tt=ee(ue,[["__scopeId","data-v-c9e2a5da"]]);export{tt as default};
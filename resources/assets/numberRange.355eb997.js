import"./vue.db505ee4.js";import{r as m,V as w,w as D,p as d,aW as g,aR as H,ar as M,bd as O,c as _,aM as V,u as x,S as T,ai as k}from"./@vue.cb43a243.js";import"./@babel.6cd0804c.js";import"./regenerator-runtime.8e24db72.js";const A={name:"ExNumberRange"},$=Object.assign(A,{props:{value:Array,separator:{type:String,default:"-"}},emits:["update:value"],setup(i,{emit:f}){const s=i,e=m(null),a=m(null),t=w();p(),D(()=>s.value,(l,u)=>{JSON.stringify(l)!=JSON.stringify(u)&&p()});function p(){s.value.length>0?(e.value=s.value[0],a.value=s.value[1]):(e.value=null,a.value=null),n()}function n(){e.value===null&&a.value===null?f("update:value",[]):f("update:value",[e.value,a.value])}let r=!1;function b(){r=!1}function S(l){e.value===null&&(a.value=null),setTimeout(()=>{e.value!==null&&!a.value&&(a.value=o()),e.value!==null&&e.value===a.value&&(a.value=o()),n()},500)}function y(){r=!0,e.value===null&&a.value!==null&&(e.value=N()),setTimeout(()=>{a.value===null&&r&&(e.value=null),n()},300)}function o(){const l=t.step||1;return e.value+l}function N(){const l=t.step||1;return a.value-l}const B=d(()=>o()),C=d(()=>{if(t.max){const l=t.step||1;return t.max-l}return null});return(l,u)=>{const c=g("a-input-number"),h=g("a-form-item-rest");return H(),M(h,null,{default:O(()=>[_(c,V(l.$attrs,{max:x(C),value:e.value,"onUpdate:value":u[0]||(u[0]=v=>e.value=v),onChange:n,onFocus:b,onBlur:S}),null,16,["max","value"]),T(" "+k(i.separator)+" ",1),_(c,V(l.$attrs,{min:x(B),value:a.value,"onUpdate:value":u[1]||(u[1]=v=>a.value=v),onChange:n,onBlur:y}),null,16,["min","value"])]),_:1})}}});export{$ as default};

import"./vue.ba0abfb8.js";import{_ as _export_sfc,a as useInjectRenderContext,c as exceptField,i as isNumber}from"./index.4e0ae27c.js";import{l as lodash}from"./lodash.c9cf1bdb.js";import{u as useHttp}from"./use-http.bb895d9a.js";import{r as ref,U as useAttrs,w as watch,a6 as isReactive,p as computed,aW as resolveComponent,aR as openBlock,ar as createBlock,bd as withCtx,W as renderSlot,c as createVNode,aM as mergeProps}from"./@vue.cfb5b4bf.js";import{w as watchDebounced}from"./@vueuse.87c3d595.js";import"./vue-router.49809928.js";import"./js-md5.5179c6be.js";import"./@babel.6cd0804c.js";import"./regenerator-runtime.8e24db72.js";import"./spark-md5.2cc5764b.js";import"./axios.e3200588.js";import"./ant-design-vue.ad0ac899.js";import"./@ant-design.ad6c0a17.js";import"./@ctrl.fa7cbd46.js";import"./resize-observer-polyfill.8deb1e21.js";import"./vue-types.6e6d84ba.js";import"./dom-align.f1b5d360.js";import"./lodash-es.0ea26897.js";import"./dayjs.38e390ea.js";import"./async-validator.5d25c98b.js";import"./scroll-into-view-if-needed.5191fdbf.js";import"./compute-scroll-into-view.6058b3be.js";import"./js-cookie.31874410.js";/* empty css                     */import"./clipboard.099d05c9.js";import"./markdown-it.20180ffc.js";import"./entities.0d2c0164.js";import"./uc.micro.981ceb7b.js";import"./mdurl.ef76b4dc.js";import"./linkify-it.92c30060.js";import"./markdown-it-emoji.e3e91710.js";import"./escape-html.e5dfadb9.js";import"./prismjs.1971588a.js";import"./diacritics.6be19c75.js";import"./markdown-it-container.512a5043.js";import"./markdown-it-anchor.c88e5394.js";import"./markdown-it-attrs.3af5ab50.js";import"./markdown-it-table-of-contents.8a4ce16f.js";import"./vue-demi.a71c3140.js";var form_vue_vue_type_style_index_0_scoped_true_lang="";const __default__={name:"ExForm",inheritAttrs:!1},_sfc_main=Object.assign(__default__,{props:{url:String,method:{type:String,default:"POST"},exceptField:{type:Array,default:[]},editId:{type:[String,Number],default:null},callParams:{type:Object,default:{}},params:{type:Object,default:{}},tabsValidateField:{type:Array,default:[]},watch:{type:Array,default:[]},stepCurrent:[String,Number]},emits:["submit","success","formModalClose","gridRefresh","update:stepCurrent","watchModel"],setup(__props,{expose,emit}){const props=__props,form=ref(),attrs=useAttrs(),watchData=[],proxyData=useInjectRenderContext(),stepResult=ref(null),{loading,http}=useHttp();let watchPauseField;watch(attrs.model,t=>{emit("watchModel",t)}),props.watch.forEach(field=>{const watchValue=eval("attrs.model."+field);isReactive(watchValue)?watchDebounced(computed(()=>JSON.stringify(eval("attrs.model."+field))),(t,e)=>{watchQueue(field,JSON.parse(t),JSON.parse(e))},{debounce:300,maxWait:1e3,deep:!0}):watchDebounced(()=>eval("attrs.model."+field),(t,e)=>{watchQueue(field,t,e)},{debounce:300,maxWait:1e3})});function watchQueue(t,e,a){if(watchPauseField==t)return watchPauseField=null,!1;const r=watchData.length;JSON.stringify(e)!=JSON.stringify(a)&&watchData.push({field:t,newValue:e,oldValue:a}),r===0&&watchListen()}async function watchListen(){const e=JSON.parse(JSON.stringify(watchData)).shift();e&&(await watchAjax(e.field,e.newValue,e.oldValue),watchData.shift(),watchListen())}function watchAjax(t,e,a){return new Promise((r,i)=>{http({url:props.url,method:props.method,data:Object.assign(props.callParams,{ex_admin_action:"watch",data:submitData(),field:t,newValue:e,oldValue:a,formField:attrs.formField},props.params)}).then(o=>{o.data.showField.forEach(s=>{proxyData[s]=1}),o.data.hideField.forEach(s=>{proxyData[s]=0});let l=o.data.data;for(let s in l)isReactive(attrs.model[s])&&t==s&&(watchPauseField=t),attrs.model[s]=l[s];r(o)}).catch(o=>{r(o)})})}function submitData(){const t=JSON.parse(JSON.stringify(attrs.model));return exceptField(t,props.exceptField),t}function scrollToField(t){let e=t.map(a=>isNumber(a)?"*":a);lodash.exports.forEach(props.tabsValidateField,function(a){lodash.exports.forEach(a,function(r,i){e.join(".")==i&&lodash.exports.forEach(r,function(o){proxyData[o.model]=o.key})})}),form.value.scrollToField(t,{block:"center",behavior:"smooth"})}function validate(t,e,a){t=t.join("."),e?(attrs.validateField[t].message=null,attrs.validateField[t].status=null):(attrs.validateField[t].status="error",attrs.validateField[t].message=a)}function submit(){const t=submitData();emit("submit",t),form.value.validate().then(()=>{props.url?http({url:props.url,method:props.method,data:Object.assign(props.callParams,{ex_admin_action:"save",data:t,CURRENT_VALIDATION_STEP:props.stepCurrent,FORM_REF:attrs.form_ref,id:props.editId},props.params)}).then(e=>{if(e.code===422){let a="";for(let r in e.data){a||(a=r);let i=e.data[r];attrs.validateField[r].status="error",attrs.validateField[r].message=Array.isArray(i)?i[0]:i}scrollToField([a]);return}else if(e.code===201){emit("update:stepCurrent",props.stepCurrent+1);return}else e.code===202&&(emit("update:stepCurrent",props.stepCurrent+1),stepResult.value=e.data);emit("success",e),emit("gridRefresh"),emit("formModalClose")}):(emit("success"),emit("gridRefresh"),emit("formModalClose"))}).catch(e=>{scrollToField(e.errorFields[0].name)})}function stepReset(){emit("update:stepCurrent",0),form.value.resetFields(),stepResult.value=null}return expose({stepReset,form,loading,submit}),(t,e)=>{const a=resolveComponent("render"),r=resolveComponent("a-form");return openBlock(),createBlock(r,mergeProps({class:"form",ref_key:"form",ref:form,onValidate:validate},t.$attrs),{default:withCtx(()=>[renderSlot(t.$slots,"default",{},void 0,!0),createVNode(a,{data:stepResult.value},null,8,["data"]),renderSlot(t.$slots,"footer",{},void 0,!0)]),_:3},16)}}});var form=_export_sfc(_sfc_main,[["__scopeId","data-v-32a71f30"]]);export{form as default};

"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[136],{4325:(e,t,n)=>{n.d(t,{Z:()=>l});var i=n(4019),o=n(6598),l={name:"Button",props:{label:{type:String},icon:{type:String},iconPos:{type:String,default:"left"},badge:{type:String},badgeClass:{type:String,default:null},loading:{type:Boolean,default:!1},loadingIcon:{type:String,default:"pi pi-spinner pi-spin"}},computed:{buttonClass(){return{"p-button p-component":!0,"p-button-icon-only":this.icon&&!this.label,"p-button-vertical":("top"===this.iconPos||"bottom"===this.iconPos)&&this.label,"p-disabled":this.$attrs.disabled||this.loading,"p-button-loading":this.loading,"p-button-loading-label-only":this.loading&&!this.icon&&this.label}},iconClass(){return[this.loading?"p-button-loading-icon "+this.loadingIcon:this.icon,"p-button-icon",{"p-button-icon-left":"left"===this.iconPos&&this.label,"p-button-icon-right":"right"===this.iconPos&&this.label,"p-button-icon-top":"top"===this.iconPos&&this.label,"p-button-icon-bottom":"bottom"===this.iconPos&&this.label}]},badgeStyleClass(){return["p-badge p-component",this.badgeClass,{"p-badge-no-gutter":this.badge&&1===String(this.badge).length}]},disabled(){return this.$attrs.disabled||this.loading}},directives:{ripple:i.Z}};const s=["disabled"],a={class:"p-button-label"};l.render=function(e,t,n,i,l,r){const c=(0,o.resolveDirective)("ripple");return(0,o.withDirectives)(((0,o.openBlock)(),(0,o.createElementBlock)("button",{class:(0,o.normalizeClass)(r.buttonClass),type:"button",disabled:r.disabled},[(0,o.renderSlot)(e.$slots,"default",{},(()=>[n.loading&&!n.icon?((0,o.openBlock)(),(0,o.createElementBlock)("span",{key:0,class:(0,o.normalizeClass)(r.iconClass)},null,2)):(0,o.createCommentVNode)("",!0),n.icon?((0,o.openBlock)(),(0,o.createElementBlock)("span",{key:1,class:(0,o.normalizeClass)(r.iconClass)},null,2)):(0,o.createCommentVNode)("",!0),(0,o.createElementVNode)("span",a,(0,o.toDisplayString)(n.label||" "),1),n.badge?((0,o.openBlock)(),(0,o.createElementBlock)("span",{key:2,class:(0,o.normalizeClass)(r.badgeStyleClass)},(0,o.toDisplayString)(n.badge),3)):(0,o.createCommentVNode)("",!0)]))],10,s)),[[c]])}},590:(e,t,n)=>{n.d(t,{Z:()=>i});var i=(0,n(6954).Nd)()},4019:(e,t,n)=>{n.d(t,{Z:()=>r});var i=n(6954);function o(e){let t=a(e);t&&(!function(e){e.removeEventListener("mousedown",l)}(e),t.removeEventListener("animationend",s),t.remove())}function l(e){let t=e.currentTarget,n=a(t);if(!n||"none"===getComputedStyle(n,null).display)return;if(i.p7.removeClass(n,"p-ink-active"),!i.p7.getHeight(n)&&!i.p7.getWidth(n)){let e=Math.max(i.p7.getOuterWidth(t),i.p7.getOuterHeight(t));n.style.height=e+"px",n.style.width=e+"px"}let o=i.p7.getOffset(t),l=e.pageX-o.left+document.body.scrollTop-i.p7.getWidth(n)/2,s=e.pageY-o.top+document.body.scrollLeft-i.p7.getHeight(n)/2;n.style.top=s+"px",n.style.left=l+"px",i.p7.addClass(n,"p-ink-active")}function s(e){i.p7.removeClass(e.currentTarget,"p-ink-active")}function a(e){for(let t=0;t<e.children.length;t++)if("string"==typeof e.children[t].className&&-1!==e.children[t].className.indexOf("p-ink"))return e.children[t];return null}const r={mounted(e,t){t.instance.$primevue&&t.instance.$primevue.config&&t.instance.$primevue.config.ripple&&(function(e){let t=document.createElement("span");t.className="p-ink",e.appendChild(t),t.addEventListener("animationend",s)}(e),function(e){e.addEventListener("mousedown",l)}(e))},unmounted(e){o(e)}}},3744:(e,t)=>{t.Z=(e,t)=>{const n=e.__vccOpts||e;for(const[e,i]of t)n[e]=i;return n}},136:(e,t,n)=>{n.r(t),n.d(t,{default:()=>z});var i=n(6598),o={class:"flex flex-wrap items-center justify-between w-full py-4 lg:py-0 px-4 text-lg text-gray-700 bg-white"},l={class:"flex items-center p-3"},s=(0,i.createTextVNode)("Ventazan.ga "),a={key:0,class:"ml-6 text-base"},r=[(0,i.createElementVNode)("path",{"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,-1)],c={class:"pt-2 text-base text-gray-700 lg:flex lg:justify-between lg:pt-0"},d={key:0},u={class:"block m-1.5"},p={key:1},m={class:"block m-1.5"},h={key:2},b={class:"block m-1.5"};var v=n(9680),k=n(4325),f=n(6954),g=n(590),y=n(4019),C={name:"TieredMenuSub",emits:["leaf-click","keydown-item"],props:{model:{type:Array,default:null},root:{type:Boolean,default:!1},popup:{type:Boolean,default:!1},parentActive:{type:Boolean,default:!1},template:{type:Function,default:null},exact:{type:Boolean,default:!0}},documentClickListener:null,watch:{parentActive(e){e||(this.activeItem=null)}},data:()=>({activeItem:null}),updated(){this.root&&this.activeItem&&this.bindDocumentClickListener()},beforeUnmount(){this.unbindDocumentClickListener()},methods:{onItemMouseEnter(e,t){this.disabled(t)?e.preventDefault():this.root?(this.activeItem||this.popup)&&(this.activeItem=t):this.activeItem=t},onItemClick(e,t,n){this.disabled(t)?e.preventDefault():(t.command&&t.command({originalEvent:e,item:t}),t.items&&(this.activeItem&&t===this.activeItem?this.activeItem=null:this.activeItem=t),t.items||this.onLeafClick(),t.to&&n&&n(e))},onLeafClick(){this.activeItem=null,this.$emit("leaf-click")},onItemKeyDown(e,t){let n=e.currentTarget.parentElement;switch(e.which){case 40:var i=this.findNextItem(n);i&&i.children[0].focus(),e.preventDefault();break;case 38:var o=this.findPrevItem(n);o&&o.children[0].focus(),e.preventDefault();break;case 39:t.items&&(this.activeItem=t,setTimeout((()=>{n.children[1].children[0].children[0].focus()}),50)),e.preventDefault()}this.$emit("keydown-item",{originalEvent:e,element:n})},onChildItemKeyDown(e){37===e.originalEvent.which&&(this.activeItem=null,e.element.parentElement.previousElementSibling.focus())},findNextItem(e){let t=e.nextElementSibling;return t?f.p7.hasClass(t,"p-disabled")||!f.p7.hasClass(t,"p-menuitem")?this.findNextItem(t):t:null},findPrevItem(e){let t=e.previousElementSibling;return t?f.p7.hasClass(t,"p-disabled")||!f.p7.hasClass(t,"p-menuitem")?this.findPrevItem(t):t:null},getItemClass(e){return["p-menuitem",e.class,{"p-menuitem-active":this.activeItem===e}]},linkClass(e,t){return["p-menuitem-link",{"p-disabled":this.disabled(e),"router-link-active":t&&t.isActive,"router-link-active-exact":this.exact&&t&&t.isExactActive}]},bindDocumentClickListener(){this.documentClickListener||(this.documentClickListener=e=>{this.$el&&!this.$el.contains(e.target)&&(this.activeItem=null,this.unbindDocumentClickListener())},document.addEventListener("click",this.documentClickListener))},unbindDocumentClickListener(){this.documentClickListener&&(document.removeEventListener("click",this.documentClickListener),this.documentClickListener=null)},visible:e=>"function"==typeof e.visible?e.visible():!1!==e.visible,disabled:e=>"function"==typeof e.disabled?e.disabled():e.disabled,label:e=>"function"==typeof e.label?e.label():e.label},computed:{containerClass(){return{"p-submenu-list":!this.root}}},directives:{ripple:y.Z}};const x=["onMouseenter"],B=["href","onClick","onKeydown"],E={class:"p-menuitem-text"},I=["href","target","aria-haspopup","aria-expanded","onClick","onKeydown","tabindex"],L={class:"p-menuitem-text"},w={key:0,class:"p-submenu-icon pi pi-angle-right"};C.render=function(e,t,n,o,l,s){const a=(0,i.resolveComponent)("router-link"),r=(0,i.resolveComponent)("TieredMenuSub",!0),c=(0,i.resolveDirective)("ripple");return(0,i.openBlock)(),(0,i.createElementBlock)("ul",{ref:"element",class:(0,i.normalizeClass)(s.containerClass),role:"'menubar' : 'menu'","aria-orientation":"horizontal"},[((0,i.openBlock)(!0),(0,i.createElementBlock)(i.Fragment,null,(0,i.renderList)(n.model,((e,t)=>((0,i.openBlock)(),(0,i.createElementBlock)(i.Fragment,{key:s.label(e)+t.toString()},[s.visible(e)&&!e.separator?((0,i.openBlock)(),(0,i.createElementBlock)("li",{key:0,class:(0,i.normalizeClass)(s.getItemClass(e)),style:(0,i.normalizeStyle)(e.style),onMouseenter:t=>s.onItemMouseEnter(t,e),role:"none"},[n.template?((0,i.openBlock)(),(0,i.createBlock)((0,i.resolveDynamicComponent)(n.template),{key:1,item:e},null,8,["item"])):((0,i.openBlock)(),(0,i.createElementBlock)(i.Fragment,{key:0},[e.to&&!s.disabled(e)?((0,i.openBlock)(),(0,i.createBlock)(a,{key:0,to:e.to,custom:""},{default:(0,i.withCtx)((({navigate:t,href:n,isActive:o,isExactActive:l})=>[(0,i.withDirectives)(((0,i.openBlock)(),(0,i.createElementBlock)("a",{href:n,onClick:n=>s.onItemClick(n,e,t),class:(0,i.normalizeClass)(s.linkClass(e,{isActive:o,isExactActive:l})),onKeydown:t=>s.onItemKeyDown(t,e),role:"menuitem"},[(0,i.createElementVNode)("span",{class:(0,i.normalizeClass)(["p-menuitem-icon",e.icon])},null,2),(0,i.createElementVNode)("span",E,(0,i.toDisplayString)(s.label(e)),1)],42,B)),[[c]])])),_:2},1032,["to"])):(0,i.withDirectives)(((0,i.openBlock)(),(0,i.createElementBlock)("a",{key:1,href:e.url,class:(0,i.normalizeClass)(s.linkClass(e)),target:e.target,"aria-haspopup":null!=e.items,"aria-expanded":e===l.activeItem,onClick:t=>s.onItemClick(t,e),onKeydown:t=>s.onItemKeyDown(t,e),role:"menuitem",tabindex:s.disabled(e)?null:"0"},[(0,i.createElementVNode)("span",{class:(0,i.normalizeClass)(["p-menuitem-icon",e.icon])},null,2),(0,i.createElementVNode)("span",L,(0,i.toDisplayString)(s.label(e)),1),e.items?((0,i.openBlock)(),(0,i.createElementBlock)("span",w)):(0,i.createCommentVNode)("",!0)],42,I)),[[c]])],64)),s.visible(e)&&e.items?((0,i.openBlock)(),(0,i.createBlock)(r,{model:e.items,key:s.label(e)+"_sub_",template:n.template,onLeafClick:s.onLeafClick,onKeydownItem:s.onChildItemKeyDown,parentActive:e===l.activeItem,exact:n.exact},null,8,["model","template","onLeafClick","onKeydownItem","parentActive","exact"])):(0,i.createCommentVNode)("",!0)],46,x)):(0,i.createCommentVNode)("",!0),s.visible(e)&&e.separator?((0,i.openBlock)(),(0,i.createElementBlock)("li",{class:(0,i.normalizeClass)(["p-menu-separator",e.class]),style:(0,i.normalizeStyle)(e.style),key:"separator"+t.toString(),role:"separator"},null,6)):(0,i.createCommentVNode)("",!0)],64)))),128))],2)};var N={name:"TieredMenu",inheritAttrs:!1,props:{popup:{type:Boolean,default:!1},model:{type:Array,default:null},appendTo:{type:String,default:"body"},autoZIndex:{type:Boolean,default:!0},baseZIndex:{type:Number,default:0},exact:{type:Boolean,default:!0}},target:null,container:null,outsideClickListener:null,scrollHandler:null,resizeListener:null,data:()=>({visible:!1}),beforeUnmount(){this.unbindResizeListener(),this.unbindOutsideClickListener(),this.scrollHandler&&(this.scrollHandler.destroy(),this.scrollHandler=null),this.target=null,this.container&&this.autoZIndex&&f.P9.clear(this.container),this.container=null},methods:{itemClick(e){const t=e.item;t.command&&(t.command(e),e.originalEvent.preventDefault()),this.hide()},toggle(e){this.visible?this.hide():this.show(e)},show(e){this.visible=!0,this.target=e.currentTarget},hide(){this.visible=!1},onEnter(e){this.alignOverlay(),this.bindOutsideClickListener(),this.bindResizeListener(),this.bindScrollListener(),this.autoZIndex&&f.P9.set("menu",e,this.baseZIndex+this.$primevue.config.zIndex.menu)},onLeave(){this.unbindOutsideClickListener(),this.unbindResizeListener(),this.unbindScrollListener()},onAfterLeave(e){this.autoZIndex&&f.P9.clear(e)},alignOverlay(){f.p7.absolutePosition(this.container,this.target),this.container.style.minWidth=f.p7.getOuterWidth(this.target)+"px"},bindOutsideClickListener(){this.outsideClickListener||(this.outsideClickListener=e=>{this.visible&&this.container&&!this.container.contains(e.target)&&!this.isTargetClicked(e)&&this.hide()},document.addEventListener("click",this.outsideClickListener))},unbindOutsideClickListener(){this.outsideClickListener&&(document.removeEventListener("click",this.outsideClickListener),this.outsideClickListener=null)},bindScrollListener(){this.scrollHandler||(this.scrollHandler=new f.Vr(this.target,(()=>{this.visible&&this.hide()}))),this.scrollHandler.bindScrollListener()},unbindScrollListener(){this.scrollHandler&&this.scrollHandler.unbindScrollListener()},bindResizeListener(){this.resizeListener||(this.resizeListener=()=>{this.visible&&this.hide()},window.addEventListener("resize",this.resizeListener))},unbindResizeListener(){this.resizeListener&&(window.removeEventListener("resize",this.resizeListener),this.resizeListener=null)},isTargetClicked(e){return this.target&&(this.target===e.target||this.target.contains(e.target))},onLeafClick(){this.popup&&this.hide()},containerRef(e){this.container=e},onOverlayClick(e){g.Z.emit("overlay-click",{originalEvent:e,target:this.target})}},computed:{containerClass(){return["p-tieredmenu p-component",{"p-tieredmenu-overlay":this.popup,"p-input-filled":"filled"===this.$primevue.config.inputStyle,"p-ripple-disabled":!1===this.$primevue.config.ripple}]}},components:{TieredMenuSub:C}};!function(e,t){void 0===t&&(t={});var n=t.insertAt;if(e&&"undefined"!=typeof document){var i=document.head||document.getElementsByTagName("head")[0],o=document.createElement("style");o.type="text/css","top"===n&&i.firstChild?i.insertBefore(o,i.firstChild):i.appendChild(o),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(document.createTextNode(e))}}("\n.p-tieredmenu-overlay {\n    position: absolute;\n    top: 0;\n    left: 0;\n}\n.p-tieredmenu ul {\n    margin: 0;\n    padding: 0;\n    list-style: none;\n}\n.p-tieredmenu .p-submenu-list {\n    position: absolute;\n    min-width: 100%;\n    z-index: 1;\n    display: none;\n}\n.p-tieredmenu .p-menuitem-link {\n    cursor: pointer;\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    -webkit-box-align: center;\n        -ms-flex-align: center;\n            align-items: center;\n    text-decoration: none;\n    overflow: hidden;\n    position: relative;\n}\n.p-tieredmenu .p-menuitem-text {\n    line-height: 1;\n}\n.p-tieredmenu .p-menuitem {\n    position: relative;\n}\n.p-tieredmenu .p-menuitem-link .p-submenu-icon {\n    margin-left: auto;\n}\n.p-tieredmenu .p-menuitem-active > .p-submenu-list {\n    display: block;\n    left: 100%;\n    top: 0;\n}\n"),N.render=function(e,t,n,o,l,s){const a=(0,i.resolveComponent)("TieredMenuSub");return(0,i.openBlock)(),(0,i.createBlock)(i.Teleport,{to:n.appendTo,disabled:!n.popup},[(0,i.createVNode)(i.Transition,{name:"p-connected-overlay",onEnter:s.onEnter,onLeave:s.onLeave,onAfterLeave:s.onAfterLeave},{default:(0,i.withCtx)((()=>[!n.popup||l.visible?((0,i.openBlock)(),(0,i.createElementBlock)("div",(0,i.mergeProps)({key:0,ref:s.containerRef,class:s.containerClass},e.$attrs,{onClick:t[0]||(t[0]=(...e)=>s.onOverlayClick&&s.onOverlayClick(...e))}),[(0,i.createVNode)(a,{model:n.model,root:!0,popup:n.popup,onLeafClick:s.onLeafClick,template:e.$slots.item,exact:n.exact},null,8,["model","popup","onLeafClick","template","exact"])],16)):(0,i.createCommentVNode)("",!0)])),_:1},8,["onEnter","onLeave","onAfterLeave"])],8,["to","disabled"])};var S={name:"SplitButton",inheritAttrs:!1,props:{label:{type:String,default:null},icon:{type:String,default:null},model:{type:Array,default:null},autoZIndex:{type:Boolean,default:!0},baseZIndex:{type:Number,default:0},appendTo:{type:String,default:"body"},class:null,style:null},methods:{onDropdownButtonClick(){this.$refs.menu.toggle({currentTarget:this.$el})},onDefaultButtonClick(){this.$refs.menu.hide()}},computed:{ariaId:()=>(0,f.Th)(),containerClass(){return["p-splitbutton p-component",this.class]}},components:{PVSButton:k.Z,PVSMenu:N}};!function(e,t){void 0===t&&(t={});var n=t.insertAt;if(e&&"undefined"!=typeof document){var i=document.head||document.getElementsByTagName("head")[0],o=document.createElement("style");o.type="text/css","top"===n&&i.firstChild?i.insertBefore(o,i.firstChild):i.appendChild(o),o.styleSheet?o.styleSheet.cssText=e:o.appendChild(document.createTextNode(e))}}("\n.p-splitbutton[data-v-3d44cde8] {\n    display: -webkit-inline-box;\n    display: -ms-inline-flexbox;\n    display: inline-flex;\n    position: relative;\n}\n.p-splitbutton .p-splitbutton-defaultbutton[data-v-3d44cde8],\n.p-splitbutton.p-button-rounded > .p-splitbutton-defaultbutton.p-button[data-v-3d44cde8],\n.p-splitbutton.p-button-outlined > .p-splitbutton-defaultbutton.p-button[data-v-3d44cde8] {\n    -webkit-box-flex: 1;\n        -ms-flex: 1 1 auto;\n            flex: 1 1 auto;\n    border-top-right-radius: 0;\n    border-bottom-right-radius: 0;\n    border-right: 0 none;\n}\n.p-splitbutton-menubutton[data-v-3d44cde8],\n.p-splitbutton.p-button-rounded > .p-splitbutton-menubutton.p-button[data-v-3d44cde8],\n.p-splitbutton.p-button-outlined > .p-splitbutton-menubutton.p-button[data-v-3d44cde8] {\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n    -webkit-box-align: center;\n        -ms-flex-align: center;\n            align-items: center;\n    -webkit-box-pack: center;\n        -ms-flex-pack: center;\n            justify-content: center;\n    border-top-left-radius: 0;\n    border-bottom-left-radius: 0;\n}\n.p-splitbutton .p-menu[data-v-3d44cde8] {\n    min-width: 100%;\n}\n.p-fluid .p-splitbutton[data-v-3d44cde8]  {\n    display: -webkit-box;\n    display: -ms-flexbox;\n    display: flex;\n}\n"),S.render=function(e,t,n,o,l,s){const a=(0,i.resolveComponent)("PVSButton"),r=(0,i.resolveComponent)("PVSMenu");return(0,i.openBlock)(),(0,i.createElementBlock)("div",{class:(0,i.normalizeClass)(s.containerClass),style:(0,i.normalizeStyle)(n.style)},[(0,i.renderSlot)(e.$slots,"default",{},(()=>[(0,i.createVNode)(a,(0,i.mergeProps)({type:"button",class:"p-splitbutton-defaultbutton"},e.$attrs,{icon:n.icon,label:n.label,onClick:s.onDefaultButtonClick}),null,16,["icon","label","onClick"])])),(0,i.createVNode)(a,{type:"button",class:"p-splitbutton-menubutton",icon:"pi pi-chevron-down",onClick:s.onDropdownButtonClick,disabled:e.$attrs.disabled,"aria-haspopup":"true","aria-controls":s.ariaId+"_overlay"},null,8,["onClick","disabled","aria-controls"]),(0,i.createVNode)(r,{id:s.ariaId+"_overlay",ref:"menu",model:n.model,popup:!0,autoZIndex:n.autoZIndex,baseZIndex:n.baseZIndex,appendTo:n.appendTo},null,8,["id","model","autoZIndex","baseZIndex","appendTo"])],6)},S.__scopeId="data-v-3d44cde8";const V={components:{SplitButton:S},props:{usuario:{type:Object,default:null}},data:function(){return{user_items:[{label:"Crear una venta",command:function(){v.Inertia.visit(route("ventas"))}},{label:"Mis ventas",command:function(){v.Inertia.visit(route("ventas"))}}],adm_items:[{label:"Categorías y características",command:function(){v.Inertia.visit(route("categorias_adm"))}},{label:"Ver usuarios y personas",command:function(){v.Inertia.visit(route("usuarios_adm"))}},{label:"Ver ciudades, roles y marcas",command:function(){v.Inertia.visit(route("ciudadroles_adm"))}},{label:"Empresas y sedes",command:function(){v.Inertia.visit(route("empresas_sedes_adm"))}},{label:"Bancos y razones sociales",command:function(){v.Inertia.visit(route("bancos_razon_social_adm"))}}],empleado_items:[{label:"Registrar envio",icon:"pi pi-fw pi-pencil",command:function(){v.Inertia.visit(route("envios_emp"))}},{label:"Vias y estados",icon:"pi pi-fw pi-users",command:function(){v.Inertia.visit(route("vias_estados_emp"))}},{label:"Facturas",icon:"pi pi-fw pi-map-marker",command:function(){v.Inertia.visit(route("facturas_emp"))}}],menuOptions:{show:!0}}},methods:{irARuta:function(e){v.Inertia.visit(route(e))},irACasa:function(){v.Inertia.visit(route("home"))}}};const z=(0,n(3744).Z)(V,[["render",function(e,t,n,v,k,f){var g,y,C,x,B,E,I=(0,i.resolveComponent)("SplitButton");return(0,i.openBlock)(),(0,i.createElementBlock)("header",null,[(0,i.createElementVNode)("nav",o,[(0,i.createElementVNode)("div",l,[(0,i.createElementVNode)("a",{class:"text-4xl",onClick:t[0]||(t[0]=function(e){return f.irARuta("Home")})},[s,n.usuario?((0,i.openBlock)(),(0,i.createElementBlock)("p",a," Bienvenido "+(0,i.toDisplayString)(n.usuario.datos_usuario.nombre)+"! ",1)):(0,i.createCommentVNode)("",!0)])]),((0,i.openBlock)(),(0,i.createElementBlock)("svg",{xmlns:"http://www.w3.org/2000/svg",id:"menu-button",onClick:t[1]||(t[1]=function(e){return k.menuOptions.show=!k.menuOptions.show}),class:"h-6 w-6 cursor-pointer lg:hidden block",fill:"none",viewBox:"0 0 24 24",stroke:"currentColor"},r)),(0,i.createElementVNode)("div",{class:(0,i.normalizeClass)("w-full lg:flex lg:items-center lg:w-auto"+(k.menuOptions.show?" hidden":"")),id:"menu"},[(0,i.createElementVNode)("ul",c,["Administrador"==(null===(g=n.usuario)||void 0===g||null===(y=g.roles)||void 0===y?void 0:y.nombre)?((0,i.openBlock)(),(0,i.createElementBlock)("li",d,[(0,i.createElementVNode)("a",u,[(0,i.createVNode)(I,{label:"Administración",model:k.adm_items,class:"p-button-md p-button-text"},null,8,["model"])])])):(0,i.createCommentVNode)("",!0),n.usuario?((0,i.openBlock)(),(0,i.createElementBlock)("li",p,[(0,i.createElementVNode)("a",m,[(0,i.createVNode)(I,{label:"Ventas",model:k.user_items,class:"p-button-md p-button-text"},null,8,["model"])])])):(0,i.createCommentVNode)("",!0),"Empleado"==(null===(C=n.usuario)||void 0===C||null===(x=C.roles)||void 0===x?void 0:x.nombre)||"Administrador"==(null===(B=n.usuario)||void 0===B||null===(E=B.roles)||void 0===E?void 0:E.nombre)?((0,i.openBlock)(),(0,i.createElementBlock)("li",h,[(0,i.createElementVNode)("a",b,[(0,i.createVNode)(I,{label:"Envios",model:k.empleado_items,class:"p-button-md p-button-text"},null,8,["model"])])])):(0,i.createCommentVNode)("",!0),(0,i.createElementVNode)("a",{class:"ml-6 hover:text-red-600 lg:p-4 py-2 block",onClick:t[2]||(t[2]=function(e){return f.irARuta("categorias")})},"Categorías"),(0,i.createElementVNode)("a",{class:"ml-6 hover:text-red-600 lg:p-4 py-2 block",onClick:t[3]||(t[3]=function(e){return f.irARuta("servicios")})},"Servicios"),(0,i.createElementVNode)("a",{class:"ml-6 hover:text-red-600 lg:p-4 py-2 block",onClick:t[4]||(t[4]=function(e){return f.irARuta("estadisticas")})},"Estadísticas"),n.usuario?(0,i.createCommentVNode)("",!0):((0,i.openBlock)(),(0,i.createElementBlock)("a",{key:3,class:"ml-6 hover:text-red-600 lg:p-4 py-2 block",onClick:t[5]||(t[5]=function(e){return f.irARuta("login")})},"Iniciar sesión")),n.usuario?(0,i.createCommentVNode)("",!0):((0,i.openBlock)(),(0,i.createElementBlock)("a",{key:4,class:"ml-6 hover:text-red-600 lg:p-4 py-2 block",onClick:t[6]||(t[6]=function(e){return f.irARuta("registrarse")})},"Regístrate")),n.usuario?((0,i.openBlock)(),(0,i.createElementBlock)("a",{key:5,class:"ml-6 hover:text-red-600 mr-4 lg:p-4 py-2 block",onClick:t[7]||(t[7]=function(e){return f.irARuta("logout")})},"Cerrar sesión")):(0,i.createCommentVNode)("",!0)])],2)])])}]])}}]);
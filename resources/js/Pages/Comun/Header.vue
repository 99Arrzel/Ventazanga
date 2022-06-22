<template>
    <header>
        <nav
            class="flex flex-wrap items-center justify-between w-full py-4 lg:py-0 px-4 text-lg text-gray-700 bg-white">
            <div class="flex items-center p-3">
                <a class="text-4xl" @click="irARuta('Home')">Ventazan.ga

                    <p class="ml-6 text-base" v-if="usuario">
                        Bienvenido {{ usuario.datos_usuario.nombre }}!
                    </p>
                </a>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" id="menu-button" @click="menuOptions.show = !menuOptions.show"
                class="h-6 w-6 cursor-pointer lg:hidden block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <div :class="
                'w-full lg:flex lg:items-center lg:w-auto' +
                (menuOptions.show ? ' hidden' : '')
            " id="menu">
                <ul class="pt-2 text-base text-gray-700 lg:flex lg:justify-between lg:pt-0">
                    <li v-if="usuario?.roles?.nombre == 'Administrador'">
                        <a class="block m-1.5">
                            <SplitButton label="Administración" :model="adm_items" class="p-button-md p-button-text">
                            </SplitButton>
                        </a>
                    </li>
                    <li v-if="usuario">
                        <a class="block m-1.5">
                            <SplitButton label="Ventas" :model="user_items" class="p-button-md p-button-text">
                            </SplitButton>
                        </a>
                    </li>
                    <li v-if="
                        usuario?.roles?.nombre == 'Empleado' ||
                        usuario?.roles?.nombre == 'Administrador'
                    ">
                        <a class="block m-1.5">
                            <SplitButton label="Envios" :model="empleado_items" class="p-button-md p-button-text">
                            </SplitButton>
                        </a>
                    </li>

                    <a class="ml-6 hover:text-red-600 lg:p-4 py-2 block" @click="irARuta('categorias')">Categorías</a>
                    <a class="ml-6 hover:text-red-600 lg:p-4 py-2 block" @click="irARuta('servicios')">Servicios</a>
                    <a class="ml-6 hover:text-red-600 lg:p-4 py-2 block"
                        @click="irARuta('estadisticas')">Estadísticas</a>
                    <a class="ml-6 hover:text-red-600 lg:p-4 py-2 block" v-if="!usuario"
                        @click="irARuta('login')">Iniciar sesión</a>
                    <a class="ml-6 hover:text-red-600 lg:p-4 py-2 block" v-if="!usuario"
                        @click="irARuta('registrarse')">Regístrate</a>
                    <a class="ml-6 hover:text-red-600 mr-4 lg:p-4 py-2 block" v-if="usuario"
                        @click="irARuta('logout')">Cerrar sesión</a>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import SplitButton from "primevue/splitbutton";
export default {
    components: {
        SplitButton,
    },
    props: {
        usuario: {
            type: Object,
            default: null,
        },
    },
    data() {
        return {
            user_items: [
                {
                    label: "Crear una venta o ver mis ventas",

                    command: () => {
                        Inertia.visit(route("ventas"));
                    },
                },

            ],
            adm_items: [
                {
                    label: "Categorías y características",

                    command: () => {
                        Inertia.visit(route("categorias_adm"));
                    },
                },
                {
                    label: "Ver usuarios y personas",

                    command: () => {
                        Inertia.visit(route("usuarios_adm"));
                    },
                },
                {
                    label: "Ver ciudades, roles y marcas",

                    command: () => {
                        Inertia.visit(route("ciudadroles_adm"));
                    },
                },
                {
                    label: "Empresas y sedes",

                    command: () => {
                        Inertia.visit(route("empresas_sedes_adm"));
                    },
                },
                {
                    label: "Bancos y razones sociales",

                    command: () => {
                        Inertia.visit(route("bancos_razon_social_adm"));
                    },
                },
            ],
            empleado_items: [
                {
                    label: "Registrar envio",
                    icon: "pi pi-fw pi-pencil",
                    command: () => {
                        Inertia.visit(route("envios_emp"));
                    },
                },
                {
                    label: "Vias y estados",
                    icon: "pi pi-fw pi-users",
                    command: () => {
                        Inertia.visit(route("vias_estados_emp"));
                    },
                },
                {
                    label: "Facturas",
                    icon: "pi pi-fw pi-map-marker",
                    command: () => {
                        Inertia.visit(route("facturas_emp"));
                    },
                },
            ],
            menuOptions: {
                show: true,
            },
        };
    },

    methods: {
        irARuta(nombre) {
            Inertia.visit(route(nombre));
        },
        irACasa() {
            Inertia.visit(route("home"));
        },
    },
};
</script>

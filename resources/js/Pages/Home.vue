<template>

    <Header v-once :usuario="usuario"> </Header>
    <div class="flex md:mx-5 mx-2">
        <div class="mt-2 mr-auto">
            <InputText placeholder="Buscar..." v-model="opciones.buscar">
            </InputText><button class=" ml-2 p-2 bg-green-600  rounded-2xl text-white" @click="base">Limpiar
                filtros</button>
            <CatArbol class="text-white" :categorias="todo_cat" @cambio="(categoria) => {
                opciones.categoria = categoria.id;
            }"></CatArbol>

        </div>
    </div>
    <div v-if="filtros.usuario_buscar > 0" class="bg-yellow-500 ml-2 rounded-lg text-white text-xl p-2 w-fit m-2">
        Estás viendo los productos de un usuario
    </div>
    <div v-if="filtros.categoria > 0" class="bg-yellow-500 ml-2 rounded-lg text-white text-xl p-2 w-fit m-2">
        Estás filtrando por categoría
    </div>
    <div v-for="categoria in categorias" :key="categoria.id">

        <div class="md:ml-5 mx-2 mt-2 text-white text-4xl" v-if="categoria.ventas.length > 0">

            <CardVenta v-if="categoria.ventas[0].usuario != null" :ventas="categoria.ventas"
                :headerText="categoria.nombre"></CardVenta>
        </div>
    </div>
    <Dialog :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }" :modal="true"
        v-model:visible="opciones.modalContacto">
        <template #header> Info del vendedor aquí </template>
    </Dialog>
</template>
<script>
import CatArbol from "./CrearVenta/ArbolSelect.vue";
import CardVenta from "./CardVenta.vue";
import Card from "primevue/card";
import Button from "primevue/button";
import Dialog from "primevue/dialog";
import Carousel from "primevue/carousel";
import Header from "./Comun/Header.vue";
import Galleria from "primevue/galleria";
import { reactive, watch } from "vue";
import InputText from "primevue/inputtext";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: { Card, Button, Carousel, Header, Galleria, Dialog, CardVenta, InputText, CatArbol },
    props: {
        filtros: {
            type: Object,
            required: true,
        },
        usuario: {
            type: Object,
            default: null,
        },
        categorias: {
            type: Array,
            default: [],
        },
        todo_cat: {
            type: Array,
            default: [],
        },

    },
    setup(props) {

        const opciones = reactive({
            modalContacto: false,
            buscar: props.filtros.buscar,
            categoria: props.filtros.categoria
        });
        /* Watch de opciones.buscar */
        watch(() => opciones.buscar, (newValue) => {

            Inertia.get(route('Home'), { buscar: newValue, usuario_buscar: props.filtros.usuario_buscar, categoria: props.filtros.categoria }, { preserveScroll: true, preserveState: true, replace: true });
        },
            { deep: true });
        watch(() => opciones.categoria, (newValue) => {
            console.log(newValue);
            Inertia.get(route('Home'), { buscar: props.filtros.buscar, usuario_buscar: props.filtros.usuario_buscar, categoria: newValue }, { replace: true });
        }, { deep: true });

        const base = () => {
            Inertia.get(route('Home'));
        }
        return { opciones, base };
    },
};
</script>

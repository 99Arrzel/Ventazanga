<template>
    <Carousel :value="ventasFil" :numVisible="ventas.length > 5 ? 5 : ventas.length" :circular="false"
        :autoplayInterval="3000" :responsiveOptions="responsiveOptions">
        <template #header>
            <p class="text-2xl text-white">Categoria: {{ headerText }}</p>
        </template>
        <template #item="slotProps">
            <div class="border-slate-700 border-2 p-2 m-2 rounded-lg flex flex-wrap flex-col">
                <p class="text-white text-center text-xl">{{ slotProps.data.nombre }}</p>
                <Galleria :value="slotProps.data.imagenes" :showThumbnails="false" :showIndicators="true">
                    <template #item="slotProps">
                        <Image preview imageClass="object-contain h-40 w-80" :alt="slotProps.item.descripcion"
                            :src="slotProps.item.url">
                            <template #indicator> Ver </template>
                        </Image>
                    </template>
                </Galleria>
                <div class="flex flex-wrap gap-1 text-white">
                    <!-- Modal detalles contiene oferta precio y detalles -->
                    <ModalDetalles :venta="slotProps.data" />
                    <div class="bg-yellow-500 rounded-lg w-fit px-1">
                        {{ evaluarTipo(slotProps.data.tipo_venta) }}
                    </div>
                    <div class="bg-violet-500 rounded-lg w-fit px-1">
                        Está en {{ slotProps.data.ciudad.nombre }}
                    </div>
                    <div v-if="evaluarEstado(slotProps.data.estado_venta)" class="bg-orange-500 rounded-lg w-fit px-1">
                        {{ evaluarEstado(slotProps.data.estado_venta) }}
                    </div>
                    <div :class="slotProps.data.marca == null ? 'bg-red-400' : 'bg-teal-700'"
                        class="rounded-lg w-fit px-1">
                        {{
                                slotProps.data.marca == null
                                    ? "Sin marca"
                                    : slotProps.data.marca.nombre
                        }}
                    </div>
                </div>
                <div class=" max-w-80">
                    <p class="text-ellipsis overflow-hidden">
                        {{ slotProps.data.descripcion }}
                    </p>

                </div>
            </div>
        </template>
    </Carousel>
</template>
<script>
import Carousel from "primevue/carousel";
import Galleria from "primevue/galleria";
import Card from "primevue/card";
import { ref } from "@vue/reactivity";
import Image from "primevue/image";
import ModalDetalles from "./ModalDetallesVenta.vue";
import { computed } from "@vue/reactivity";
export default {

    components: {
        ModalDetalles,
        Carousel,
        Image,
        Galleria,
        Card,
    },

    props: {
        ventas: {
            type: Array,
            required: true,
        },
        headerText: {
            type: String,
            required: true,
        },
    },
    setup(props) {
        const ventasFil = computed(() => {
            return props.ventas.filter(venta => {
                return venta.usuario;/* Si existe el usuario  */
            });
        });
        const evaluarEstado = (estado) => {
            if (estado == 1) {
                return "Es nuevo";
            }
            if (estado == 2) {
                return "Es usado";
            }
            return null;
        };
        const evaluarTipo = (id) => {
            if (id == 1) {
                return "Busca alquilar";
            } else if (id == 2) {
                return "Busca vender";
            } else {
                return "Ofrece servicio";
            }
        };
        const responsiveOptions = ref([
            {
                breakpoint: "1024px",
                numVisible: 3,
                numScroll: 3,
            },
            {
                breakpoint: "600px",
                numVisible: 1,
                numScroll: 1,
            },

        ]);
        const log = (e) => {
            console.log(e);
        };
        return { evaluarTipo, evaluarEstado, responsiveOptions, log, ventasFil };
    },
};
</script>

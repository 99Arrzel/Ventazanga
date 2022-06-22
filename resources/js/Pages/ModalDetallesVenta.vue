<template>
    <div class=" bg-sky-500 rounded-lg w-fit px-1 hover:bg-sky-800" v-tooltip.bottom="'Ver detalles del vendedor'"
        @click="(data.visible = true), (data.activeIndex = 0)">
        {{
                "Oferta: " + venta.usuario.datos_usuario.nombre + " " + venta.usuario.datos_usuario.apellido_p
        }}
    </div>
    <div class="bg-green-500 rounded-lg w-fit px-1">
        {{ `Precio: ${venta.precio_venta} ` }}
    </div>
    <div class="bg-fuchsia-700 px-1 rounded-lg hover:bg-fuchsia-900  " v-tooltip.bottom="'Ver detalles del producto'"
        @click="(data.visible = true), (data.activeIndex = 1)">
        Detalles
    </div>
    <Dialog header="Detalles de la venta" :modal="true" v-model:visible="data.visible"
        :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }">
        <TabView v-model:activeIndex="data.activeIndex">
            <TabPanel header="Vendedor">

                <p>
                    ¿Verificado?:
                    <span class="p-1 pt-0.5 pr-1.5 rounded-lg"
                        :class="venta.usuario.verificado == 0 ? 'bg-red-500' : 'bg-sky-300'">{{ venta.usuario.verificado == 0 ? "x" : "✓" }}</span>
                </p>

                <p>
                    Nombre:
                    {{
                            `${venta.usuario.datos_usuario.nombre} ${venta.usuario.datos_usuario.apellido_p} ${venta.usuario.datos_usuario.apellido_m ?? " "} `
                    }}
                </p>
                <p>
                    Teléfono:
                    {{
                            `${venta.usuario.datos_usuario.telefono} `
                    }}
                </p>
                <button class="bg-green-500 p-2 rounded-lg" @click="verVendedor(venta.usuario.id)">Ver
                    los productos de este
                    vendedor</button>
            </TabPanel>
            <TabPanel header="Detalles ">

                <Galleria :value="venta.imagenes" :responsiveOptions="responsiveOptions" :numVisible="5"
                    :circular="true" :showItemNavigators="true" :showThumbnails="false" :showIndicators="true">
                    <template #item="slotProps">
                        <Image preview imageClass="object-contain h-80 w-80" :alt="slotProps.item.descripcion"
                            :src="slotProps.item.url">
                            <template #indicator> Ver </template>
                        </Image>
                    </template>
                    <template #thumbnail="slotProps">
                        <img :src="slotProps.item.url" class="object-contain h-10 w-10"
                            :alt="slotProps.item.descripcion" />
                    </template>
                </Galleria>
                <!-- Imagen -->
                <div class="bg-indigo-900 rounded-lg p-1 mb-1">
                    <p>
                        Nombre:
                        {{ venta.nombre }}
                    </p>
                    <p>
                        Marca
                        <span class=" bg-sky-900 px-1 rounded-lg text-white">{{
                                venta.marca == null ? "Sin marca" : venta.marca.nombre
                        }}</span>
                    </p>
                    <p>
                        Precio de venta
                        <span class="bg-green-500 rounded-lg px-1 text-white">{{
                                venta.precio_venta
                        }}</span>
                    </p>
                    <p>Descripción</p>
                    <p>Ciudad: {{ venta.ciudad.nombre }}</p>
                    <p>Se creo esta venta el {{ getDate(venta.created_at) }}</p>
                    <p v-if="getDate(venta.created_at) != getDate(venta.updated_at)">
                        Se actualizo esta venta el {{ getDate(venta.updated_at) }}
                    </p>
                    <p>
                        Es:
                        <span v-if="evaluarEstado(venta.estado_venta)" class="bg-orange-500 rounded-lg w-fit px-1">
                            {{ evaluarEstado(venta.estado_venta) }}
                        </span>
                    </p>
                    <p>
                        El usuario quiere:
                        <span class="bg-yellow-500 rounded-lg w-fit px-1">
                            {{ evaluarTipo(venta.tipo_venta) }}
                        </span>
                    </p>
                </div>
                <!-- Listo todo ok pero necesitamos los detalles de esto, para eso ponemos una tablita con eso -->
                <div v-if="venta.caracteristicas.length > 0">
                    <div class="bg-sky-700">
                        <p class="text-white text-center ">Caracteristicas de la venta</p>
                    </div>
                    <DataTable :value="venta.caracteristicas" showGridlines responsiveLayout="scroll"
                        class="p-datatable-sm">
                        <Column header="Nombre" field="detalles.nombre">
                        </Column>
                        <Column header="Cantidad" field="cantidad">
                        </Column>
                        <Column header="Descripción" field="detalles.descripcion">
                        </Column>
                    </DataTable>
                </div>
            </TabPanel>

        </TabView>
    </Dialog>
</template>
<script>
import Dialog from "primevue/dialog";
import TabView from "primevue/tabview";
import TabPanel from "primevue/tabpanel";
import { reactive } from "@vue/reactivity";
import dayjs from "dayjs";
import Tooltip from "primevue/tooltip";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Galleria from "primevue/galleria";
import Image from "primevue/image";
import { Inertia } from "@inertiajs/inertia";
export default {
    directives: {
        Tooltip,
    },
    components: {
        Galleria,
        Image,
        DataTable,
        Column,
        Dialog,
        TabView,
        TabPanel,
    },
    props: {
        venta: {
            type: Object,
            required: true,
        },
    },
    setup() {
        const data = reactive({
            visible: false,
            activeIndex: 0,
        });
        const getDate = (date) => {
            return dayjs(date).format("DD/MM/YYYY");
        };
        const evaluarEstado = (estado) => {
            if (estado == 1) {
                return "Nuevo";
            }
            if (estado == 2) {
                return "Usado";
            }
            return null;
        };
        const evaluarTipo = (id) => {
            if (id == 1) {
                return "Alquilar";
            } else if (id == 2) {
                return "Vender";
            } else {
                return "Ofrece servicio";
            }
        };
        const responsiveOptions = [

            {
                breakpoint: '1024px',
                numVisible: 5
            },
            {
                breakpoint: '768px',
                numVisible: 3
            },
            {
                breakpoint: '560px',
                numVisible: 1
            }
        ];
        const verVendedor = (id) => {
            Inertia.get(route('Home'), { usuario_buscar: id }, { replace: true });
        };
        return { data, getDate, evaluarEstado, evaluarTipo, responsiveOptions, verVendedor };
    },
};
</script>

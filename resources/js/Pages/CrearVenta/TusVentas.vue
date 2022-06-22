<template>
    <DataTable :value="ventas" :show-gridlines="true" editMode="row" dataKey="id" v-model:editingRows="data.filaEditada"
        @row-edit-save="editarVenta" responsiveLayout="scroll" class="p-datatable-sm">
        <Column field="nombre" header="Nombre">
            <template #editor="slotProps">
                <InputText class="w-fit" v-model="slotProps.data[slotProps.field]"></InputText>
            </template>

        </Column>
        <Column field="descripcion" header="Descripción">
            <template #editor="slotProps">
                <InputText class="w-fit" v-model="slotProps.data[slotProps.field]"></InputText>
            </template>
        </Column>
        <Column field="categoria.nombre" header="Categoría"></Column>
        <Column field="estado_venta" header="Estado de venta">

            <template #body="slotProps">
                {{ evaluarEstado(slotProps.data.estado_venta) }}
            </template>

        </Column>
        <Column field="ciudad.nombre" header="Ciudad en la que vendes" style="max-width: 100px;"></Column>
        <Column field="tipo_venta" header="Tipo de venta">
            <template #body="slotProps">
                {{ evaluarTipo(slotProps.data.tipo_venta) }}
            </template>
        </Column>

        <Column field="precio_venta" header="Precio de venta">
            <template #editor="slotProps">
                <InputText class="w-fit" v-model="slotProps.data[slotProps.field]"></InputText>
            </template>
        </Column>
        <Column field="marca.nombre" header="Marca"></Column>
        <Column field="created_at" header="Creado en">
            <template #body="slotProps">
                {{ getDate(slotProps.data.created_at) }}
            </template>
        </Column>
        <Column field="imagenes" header="Imagen(es)">

            <template #body="slotProps">
                <img :src="slotProps.data.imagenes[0].url" alt="Imagen" width="100" height="100">
            </template>
        </Column>
        <Column header="Editar" :rowEditor="true" style="min-width:6rem" bodyStyle="text-align:center"></Column>
    </DataTable>


</template>
<script >
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import dayjs from "dayjs";
import { reactive } from "vue";
import InputText from "primevue/inputtext";
import { Inertia } from "@inertiajs/inertia";
import { Notify } from "notiflix";
export default {
    components: {
        InputText,
        DataTable,
        Column
    },
    /* Props de :ventas="mis_ventas" :ciudades="ciudades" :usuario="usuario" :marcas="marcas"
                :categorias="categorias" */
    props: ['ventas', 'ciudades', 'usuario', 'marcas', 'categorias'],
    setup() {
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
        const data = reactive({
            filaEditada: null,
        });
        const getDate = () => {
            return dayjs().format('DD/MM/YYYY');
        };
        const editarVenta = (e) => {
            console.log("Editar venta", e);
            let editar = {
                id: e.newData.id,
                nombre: e.newData.nombre,
                descripcion: e.newData.descripcion,
                precio_venta: e.newData.precio_venta,
            }
            Inertia.post(route('editar_venta'), editar, {
                preserveScroll: true,
                preserveState: true,

                onSuccess: () => {
                    Notify.success("Venta editada correctamente");
                },
                onError: (e) => {
                    for (let i in e) {
                        Notify.failure(e[i]);
                    }
                }
            });

        }
        return { getDate, evaluarEstado, evaluarTipo, data, editarVenta }

        // Declaracion de variables

    }


}


</script>

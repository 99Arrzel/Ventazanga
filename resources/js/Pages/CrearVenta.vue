<template>
    <Header :usuario="usuario"> </Header>
    <TabView class="sm:mx-4 mx-2 mt-4">
        <TabPanel header="Crea una venta">
            <p class="text-3xl text-white text-center">Crea una venta</p>
            <div class="m-5">
                <!-- Primero cargo datos -->

                <!-- Flex with gap -->
                <div class="flex flex-wrap gap-2 md:justify-center">
                    <div class="w-full md:w-fit">
                        <p>Nombre*</p>
                        <InputText class="w-full" placeholder="Cohete espacial..." v-model="data.nombre" />
                    </div>
                    <div class="w-full md:w-fit">
                        <p>Descripción*</p>
                        <Textarea class="w-full" placeholder="Listo para partir a marte" v-model="data.descripcion"
                            :autoResize="true" />
                    </div>
                    <div class="w-full md:w-fit">
                        <p>Categoría*</p>
                        <ArbolSelect :categorias="categorias" @cambio="(valor) => {
                            data.categoria = valor;
                        }"></ArbolSelect>
                    </div>

                    <div class="w-full md:w-fit">
                        <p>Marca</p>
                        <Dropdown :filter="true" v-model="data.marca" class="w-full md:w-fit" :options="marcas"
                            optionLabel="nombre" placeholder="SpaceX" />
                    </div>
                    <div class="w-full md:w-fit">
                        <p>Ciudad*</p>
                        <Dropdown v-model="data.ciudad" :options="ciudades" optionLabel="nombre" class="w-full"
                            placeholder="Ciudad" />
                    </div>
                    <div class="w-full md:w-fit">
                        <p>Tipo de transacción</p>
                        <Dropdown class="w-full" placeholder="Alquiler" :options="tipo_transaccion" optionLabel="label"
                            v-model="data.tipoTransaccion" />
                    </div>
                    <div class="w-full md:w-fit">
                        <p>Precio*</p>
                        <InputText class="w-full" type="number" placeholder="999999" v-model="data.precio" />
                    </div>
                    <div class="w-full md:w-fit">
                        <p>Estado</p>
                        <Dropdown class="w-full" type="number" :options="estado_venta" optionLabel="label"
                            placeholder="Selecciona un estado" v-model="data.estado"
                            :disabled="data.tipoTransaccion.label != 'Venta'" />
                    </div>
                </div>
                <!-- Aqui sección imagenes -->

                <div class="flex flex-col md:flex-row gap-2">
                    <div class="w-full md:w-3/4">
                        <p class="text-white text-center text-2xl">
                            Añade imagenes a esta venta
                        </p>
                        <FileUpload name="demo[]" @uploader="crearVenta" uploadLabel="Crear venta"
                            :showCancelButton="false" :multiple="true" accept="image/*" :maxFileSize="1000000"
                            chooseLabel="Selecciona imagenes" :customUpload="true"
                            invalidFileSizeMessage="Esa imagen es muy grande"
                            invalidFileTypeMessage="Tipo de archivo invalido"
                            invalidFileLimitMessage="Son demasiadas imagenes">
                            <template #empty>
                                <p>Arrastra imagenes para cargarlas.</p>
                            </template>
                        </FileUpload>
                    </div>
                    <div class="w-full md:w-1/4">
                        <p class="text-white text-center text-2xl">Caracteristicas</p>
                        <DataTable :value="data.tabla_c"><template #header>
                                <div class="flex flex-wrap w-full gap-2 justify-center">
                                    <Dropdown class="w-full md:w-fit" placeholder="Caracteristica"
                                        :options="data.caracteristicas_c" optionLabel="nombre"
                                        v-model="data.caracteristicas_sel" />
                                    <!-- Este de acá se podrá reemplazar con un input switch dependiendo del tipo de caracteristica... -->
                                    <div class="flex flex-inline w-full md:w-fit">
                                        <InputText class="w-full" placeholder="Cantidad" v-model="data.cantidad" />
                                        <Button class="w-full p-button-success" icon="pi pi-fw pi-plus-circle"
                                            type="button" @click="addCaracteristica"></Button>
                                    </div>
                                </div>
                            </template>
                            <Column field="nombre" header="Caracteristica"></Column>
                            <Column field="cantidad" header="Cantidad"></Column>
                            <Column><template #body="slotProps">
                                    <button class="bg-red-500 p-2 text-white rounded-lg"
                                        @click="eliminarCaracteristica(slotProps)">
                                        X
                                    </button>
                                </template></Column>
                        </DataTable>
                    </div>
                </div>

                <!-- Segundo cargo imagenes -->
            </div>
        </TabPanel>
        <!-- Le añado lo de garantias otro día -->
        <!-- <TabPanel header="Garantias"> </TabPanel> -->
        <TabPanel header="Tus ventas">
            <TusVentas :ventas="mis_ventas" :ciudades="ciudades" :usuario="usuario" :marcas="marcas"
                :categorias="categorias"></TusVentas>
        </TabPanel>
    </TabView>

</template>
<script>
import Header from "./Comun/Header.vue";
import InputText from "primevue/inputtext";
import Dropdown from "primevue/dropdown";
import MultiSelect from "primevue/multiselect";
import FileUpload from "primevue/fileupload";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";
import InputSwitch from "primevue/inputswitch";
import TabView from "primevue/tabview";
import TabPanel from "primevue/tabpanel";
import { watch, reactive, computed } from "vue";
import ArbolSelect from "./CrearVenta/ArbolSelect.vue";
import { Notify } from "notiflix";
import { Inertia } from "@inertiajs/inertia";
import Textarea from 'primevue/textarea';
import TusVentas from "./CrearVenta/TusVentas.vue";
export default {
    components: {
        TusVentas,
        Textarea,
        ArbolSelect,
        TabView,
        TabPanel,
        Button,
        DataTable,
        Column,
        Header,
        InputText,
        Dropdown,
        MultiSelect,
        InputSwitch,
        FileUpload,
    },
    props: {
        usuario: {
            type: Object,
            default: {},
        },
        categorias: {
            type: Array,
            default: [],
        },
        ciudades: {
            type: Array,
            default: [],
        },
        marcas: {
            type: Array,
            default: [],
        },
        mis_ventas: {
            type: Array,
            default: [],
        },
    },

    setup(props) {
        const quitarSoloSi = (a, b) => {
            console.log(a, b);
        }
        const estado_venta = [
            { label: "Nuevo", value: 1 },
            { label: "Usado", value: 2 },
        ];

        const tipo_transaccion = [
            {
                value: "1",
                label: "Alquiler",
            },
            {
                value: "2",
                label: "Venta",
            },
            {
                value: "3",
                label: "Servicio",
            },
        ];
        const data = reactive({
            nombre: "",
            descripcion: "",
            categoria: "",
            marca: "",
            ciudad: "",
            tipoTransaccion: "",
            precio: "",
            caracteristicas_c: [],
            caracteristicas_sel: "",
            tabla_c: [],
            cantidad: "",
        });
        watch(
            () => data.categoria,
            () => {
                //Se resetea la tabla
                data.tabla_c = [];
                data.caracteristicas_c = [];
                if (data.categoria != null) {
                    data.caracteristicas_c = data.categoria.posibles_caracteristicas;
                }
                console.log(data.categoria_c);
            },
            { deep: true }
        );

        const crearVenta = (e) => {


            /* Validamos */
            if (data.nombre == "" || data.nombre.length < 3) {
                Notify.failure("El nombre debe tener al menos 3 caracteres");
                return false;
            }
            if (data.descripcion == "" || data.descripcion.length < 5) {
                Notify.failure("La descripcion debe tener al menos 5 caracteres");
                return false;
            }
            if (data.categoria == "" || data.categoria == null) {
                Notify.failure("Debe seleccionar una categoria");
                return false;
            }
            if (data.ciudad == "" || data.ciudad == null) {
                Notify.failure("Debe seleccionar una ciudad");
                return false;
            }

            if (data.tipoTransaccion == "" || data.tipoTransaccion == null) {
                Notify.failure("Debe seleccionar un tipo de transaccion");
                return false;
            }
            if (data.precio == "") {
                Notify.failure("Debe ingresar un precio");
                return false;
            }
            console.log("e", e);
            let newData = {
                nombre: data.nombre,
                descripcion: data.descripcion,
                categoria: data.categoria.id,
                marca: data.marca.id,
                ciudad: data.ciudad.id,
                tipo_venta: data.tipoTransaccion.value,
                precio: data.precio,
                caracteristicas: data.tabla_c.map((c) => {

                    return {
                        id: c.caracteristica.id,
                        cantidad: c.cantidad,
                    };
                }),
                estado:
                    data.tipoTransaccion.label == "Venta" ? data.estado.value : null,
                imagenes: e.files,
            };
            console.log("Estáas creando con ", newData);
            Inertia.post(route("ventas_adm_create"), newData, {
                onSuccess: (response) => {
                    console.log(response);
                    Notify.success("Venta creada correctamente");
                    data.nombre = "";
                    data.descripcion = "";
                    data.categoria = null;
                    data.marca = null;
                    data.ciudad = null;
                    data.tipoTransaccion = null;
                    data.precio = "";
                    data.caracteristicas_c = [];
                    data.caracteristicas_sel = "";
                    data.tabla_c = [];
                    data.cantidad = "";
                },
                onError: (error) => {
                    for (let i in error) {
                        Notify.failure(error[i]);
                    }
                },
            });
            console.log("data", newData);
        };
        const addCaracteristica = () => {
            /* Valido cantidaad */
            if (data.cantidad === "") {
                Notify.failure("Debe ingresar una cantidad");
                return;
            }
            if (data.caracteristicas_sel == "") {
                Notify.failure("Debe ingresar una caracteristica");
                return;
            }
            data.tabla_c.push({

                caracteristica: data.caracteristicas_sel,
                cantidad: data.cantidad,
                nombre: data.caracteristicas_sel.nombre,
            });
            console.log(data.tabla_c);
            /* Eliminamos el valor de caracteristicas_sel de data.caracteristicas_c */
            data.caracteristicas_c = data.caracteristicas_c.filter(
                (caracteristica) =>
                    caracteristica.nombre !== data.caracteristicas_sel.nombre
            );
            data.cantidad = "";
            data.caracteristicas_sel = "";
        };
        const eliminarCaracteristica = (datos) => {
            console.log(data);
            //Restauramos datos a data.caracteristicas_c
            data.caracteristicas_c.push(data.tabla_c[datos.index]);
            //eliminar posición
            data.tabla_c.splice(datos.index, 1);
        };
        return {
            quitarSoloSi,
            estado_venta,
            eliminarCaracteristica,
            tipo_transaccion,
            crearVenta,
            data,
            addCaracteristica,
        };
    },
};
</script>
<style>
.p-fileupload-buttonbar>.p-button {
    color: #f5f5f5 !important;
    background-color: #64b5f6 !important;
}

.p-fileupload-row>div>.p-button-icon-only {
    background-color: rgb(219, 52, 52) !important;
    color: #f5f5f5 !important;
}
</style>

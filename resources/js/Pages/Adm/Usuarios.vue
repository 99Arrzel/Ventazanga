<template>
    <Header :usuario="usuario"> </Header>

    <div class="flex flex-col">
        <p class="text-2xl text-center text-white">Tabla de usuarios</p>
        {{ valores.usuario_seleccionado }}
        <DataTable
            :value="usuarios_c"
            :paginator="true"
            selectionMode="single"
            :rows="10"
            :scrollable="true"
            v-model:filters="filters_u"
            v-model:selection="valores.usuario_seleccionado"
            responsiveLayout="scroll"
        >
            <template #header>
                <div class="flex md:flex-row flex-col">
                    <div class="mr-auto">
                        <span class="p-input-icon-right">
                            <i class="pi pi-search" />
                            <input
                                class="p-2 text-white bg-cyan-900 rounded-lg"
                                placeholder="Buscar usuario..."
                                v-model="filters_u['global'].value"
                            />
                        </span>
                    </div>
                    <div class="flex sm:flex-row sm:ml-auto flex-col">
                        <!-- Botones para agregar, eliminar y Editar -->

                        <Dialog_U
                            :accion="'Agregar'"
                            :button_class="'m-1 bg-green-500 text-white font-bold py-2 px-4 rounded disabled:bg-gray-500 '"
                            :button_text="'Agregar'"
                            :personas="personas"
                            :roles="roles"
                            @cargarRoles="cargarRoles"
                            @actualizarUsuario="actualizarUsuario"
                        >
                        </Dialog_U>
                        <Dialog_U
                            :accion="'Editar'"
                            :button_class="'m-1 bg-yellow-500 text-white font-bold py-2 px-4 rounded disabled:bg-gray-500 '"
                            :button_text="'Editar'"
                            :personas="personas"
                            :roles="roles"
                            @cargarRoles="cargarRoles"
                            @actualizarUsuario="actualizarUsuario"
                            :usuario="valores.usuario_seleccionado"
                            :disabled_button="
                                Object.keys(valores.usuario_seleccionado ?? {})
                                    .length > 0
                                    ? false
                                    : true
                            "
                        >
                        </Dialog_U>

                        <button
                            @click="delete_u()"
                            :class="
                                valores.usuario_seleccionado.deleted_at == null
                                    ? 'm-1 disabled:bg-gray-500 text-base bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded'
                                    : 'm-1 disabled:bg-gray-500 text-base bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'
                            "
                            :disabled="
                                Object.keys(valores.usuario_seleccionado ?? {})
                                    .length > 0
                                    ? false
                                    : true
                            "
                        >
                            {{
                                valores.usuario_seleccionado.deleted_at == null
                                    ? "Eliminar"
                                    : "Restaurar"
                            }}
                        </button>
                    </div>
                </div>
            </template>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="usuario"
                header="Usuario"
            ></Column>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="nombre_rol"
                header="Rol"
            >
            </Column>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="nombre"
                header="Nombre"
            >
            </Column>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="apellido_p"
                header="Apellido Paterno"
            >
            </Column>

            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="email"
                header="Correo"
            >
            </Column>

            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="deleted_at"
                header="Estado"
            >
                <template #body="slotProps">
                    <span
                        :class="
                            slotProps.data.deleted_at == null
                                ? 'bg-green-500 p-2 rounded-lg'
                                : 'bg-red-500 p-2 rounded-lg'
                        "
                    >
                        {{
                            slotProps.data.deleted_at == null
                                ? "Activo"
                                : "De baja desde " + slotProps.data.deleted_at
                        }}
                    </span>
                </template>
            </Column>
        </DataTable>

        <p class="text-2xl text-center text-white">Tabla de personas</p>
        <DataTable
            :value="personas_c"
            :paginator="true"
            selectionMode="single"
            :rows="10"
            :scrollable="true"
            v-model:filters="filters_p"
            v-model:selection="valores.persona_seleccionada"
            responsiveLayout="scroll"
        >
            <template #header>
                <div class="flex md:flex-row flex-col">
                    <div class="mr-auto">
                        <span class="p-input-icon-right">
                            <i class="pi pi-search" />
                            <input
                                id="search"
                                class="p-2 text-white bg-cyan-900 rounded-lg"
                                placeholder="Buscar persona..."
                                v-model="filters_p.global.value"
                            />
                        </span>
                    </div>
                    <div class="flex sm:flex-row sm:ml-auto flex-col">
                        <!-- Botones para agregar, eliminar y Editar -->
                        <Dialog_P
                            :accion="'Agregar'"
                            :ciudades="ciudades"
                            @cargarCiudades="cargarCiudades"
                            @actualizarPersonas="actualizarPersonas"
                            :button_class="'m-1 bg-green-500 text-white font-bold py-2 px-4 rounded disabled:bg-gray-500 '"
                        >
                        </Dialog_P>
                        <Dialog_P
                            :persona="valores.persona_seleccionada"
                            :accion="'Editar'"
                            :button_text="'Editar'"
                            :disabled_button="
                                Object.keys(valores.persona_seleccionada ?? {})
                                    .length == 0
                            "
                            :button_class="'m-1 bg-yellow-500 text-white font-bold py-2 px-4 rounded disabled:bg-gray-500 '"
                            :ciudades="ciudades"
                            @cargarCiudades="cargarCiudades"
                            @actualizarPersonas="actualizarPersonas"
                        >
                        </Dialog_P>
                        <button
                            @click="delete_p()"
                            class="m-1 disabled:bg-gray-500 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            :disabled="
                                Object.keys(valores.persona_seleccionada ?? {})
                                    .length > 0
                                    ? false
                                    : true
                            "
                        >
                            Eliminar
                        </button>
                    </div>
                </div>
            </template>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="nombre"
                header="Nombre"
            >
            </Column>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="apellido_p"
                header="Apellido Paterno"
            >
            </Column>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="apellido_m"
                header="Apellido Materno"
            >
            </Column>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="ci"
                header="Cédula de identidad"
            >
            </Column>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="email"
                header="Correo"
            >
            </Column>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="telefono"
                header="Teléfono"
            ></Column>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="direccion"
                header="Dirección"
            >
            </Column>
            <Column
                filterMatchMode="contains"
                :sortable="true"
                field="ciudad"
                header="Ciudad"
            >
            </Column>
        </DataTable>
    </div>
</template>
<script>
import { Inertia } from "@inertiajs/inertia";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { FilterMatchMode } from "primevue/api";
import { reactive, computed, watch } from "vue";
import Header from "../Comun/Header.vue";
import Dialog_P from "../Comun/Dialog_Persona.vue";
import Dialog_U from "../Comun/Dialog_Usuario.vue";
import { Notify, Confirm, Loading } from "notiflix";
Notify.init({
    position: "center-bottom",
    clickToClose: true,
    timeout: 3000,
});
export default {
    props: {
        usuario: {
            type: Object,
            default: null,
        },
        personas: {
            type: Array,
            default: [],
        },
        ciudades: {
            type: Array,
            default: [],
        },
        roles: {
            type: Array,
            default: [],
        },
    },
    components: {
        Dialog_U,
        Dialog_P,
        Header,
        DataTable,
        Column,
    },

    setup(props) {
        const delete_u = () => {
            Inertia.post(
                valores.usuario_seleccionado.deleted_at == null
                    ? route("usuarios_adm_delete")
                    : route("usuarios_adm_restore"),
                {
                    id: valores.usuario_seleccionado.id,
                },
                {
                    only: ["personas", "flash", "errors"],
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (response) => {
                        Notify.success(response.props.flash.success.message);
                        Loading.remove(250);
                    },
                    onError: (response) => {
                        for (let message in response) {
                            Notify.failure(response[message]);
                        }
                    },
                }
            );
        };
        const cargarCiudades = () => {
            Inertia.reload({
                only: ["ciudades"],
                preserveState: true,
                preserveScroll: true,
            });
        };
        const actualizarUsuario = (data) => {
            Inertia.post(
                data.accion == "Agregar"
                    ? route("usuarios_adm_create")
                    : route("usuarios_adm_update"),
                data,
                {
                    only: ["personas", "flash", "errors"],
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (response) => {
                        Notify.success(response.props.flash.success.message);
                        Loading.remove(250);
                    },
                    onError: (response) => {
                        for (let message in response) {
                            Notify.failure(response[message]);
                        }
                    },
                }
            );
        };
        const cargarRoles = () => {
            Inertia.reload({
                only: ["roles"],
                preserveState: true,
                preserveScroll: true,
            });
        };
        const delete_p = () => {
            Confirm.init({
                titleColor: "#FF0000",
                messageColor: "#FF0000",
                okButtonBackground: "#FF0000",
            });
            Confirm.show(
                "¿Deseas eliminar a esta persona?",
                "Estás a punto de eliminar a " +
                    valores.persona_seleccionada.nombre,
                "Eliminar",
                "Cancelar",
                () => {
                    Loading.standard({
                        clickToClose: false,
                        svgSize: "200",
                    });
                    Inertia.post(
                        route("personas_adm_delete"),
                        {
                            id: valores.persona_seleccionada.id,
                        },
                        {
                            preserveState: true,
                            preserveScroll: true,
                            only: ["personas", "flash", "errors"],
                            onSuccess: (response) => {
                                Notify.success(
                                    response.props.flash.success.message
                                );
                                Loading.remove(250);
                            },
                            onError: (response) => {
                                for (let message in response) {
                                    Notify.failure(response[message]);
                                }
                                Loading.remove(250);
                            },
                        }
                    );
                }
            );
        };
        const actualizarPersonas = (data) => {
            console.log("eaeae", data);
            Inertia.post(
                data.accion == "Agregar"
                    ? route("personas_adm_create")
                    : route("personas_adm_update"),
                data,
                {
                    only: ["personas", "flash", "errors"],
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (response) => {
                        Notify.success(response.props.flash.success.message);
                    },
                    onError: (response) => {
                        for (let message in response) {
                            Notify.failure(response[message]);
                        }
                    },
                }
            );
        };
        //Make usuarioss from props.personas.filter and map as reactive

        const usuarios_c = computed({
            get() {
                console.log(props.personas);
                let retornameEsta = [];
                props.personas.forEach((persona) => {
                    persona.usuario.forEach((usuario) => {
                        retornameEsta.push({
                            id: usuario.id,
                            usuario: usuario.usuario,
                            nombre_rol: usuario.roles.nombre,
                            nombre: persona.nombre,
                            apellido_p: persona.apellido_p,
                            email: persona.email,
                            deleted_at: usuario.deleted_at,
                        });
                    });
                });
                return retornameEsta;
            },
        });

        const personas_c = computed({
            get() {
                return props.personas.map((persona) => {
                    return {
                        id: persona.id,
                        nombre: persona.nombre,
                        apellido_p: persona.apellido_p,
                        apellido_m: persona.apellido_m,
                        ci: persona.ci,
                        telefono: persona.telefono,
                        email: persona.email,
                        direccion: persona.direccion,
                        ciudad: persona.ciudad.nombre,
                    };
                });
            },
        });

        const filters_u = reactive({
            global: {
                value: "",
                matchMode: FilterMatchMode.Contains,
            },
        });

        const filters_p = reactive({
            global: {
                value: "",
                matchMode: FilterMatchMode.Contains,
            },
        });
        const valores = reactive({
            usuario_seleccionado: {},
            showModal_u: false,
            showModal_p: false,
            accion_u: "",
            accion_p: "",
            persona_seleccionada: {},
        });
        return {
            delete_u,
            delete_p,
            actualizarPersonas,
            actualizarUsuario,
            cargarCiudades,
            cargarRoles,
            personas_c,
            filters_u,
            filters_p,
            usuarios_c,
            valores,
        };
    },
};
</script>

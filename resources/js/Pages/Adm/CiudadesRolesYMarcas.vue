<template>
    <Header :usuario="usuario"> </Header>

    <div class="sm:m-10">
        <div class="flex flex-wrap justify-center gap-2">
            <div>
                <p class="text-center text-2xl lg:mb-2 text-white">Roles</p>
                <DataTable
                    :value="roles_c"
                    :rows="10"
                    :paginator="true"
                    selectionMode="single"
                    editMode="cell"
                    @cell-edit-complete="onCellEditRoles"
                    v-model:selection="data.rol"
                    v-model:filters="filtersRoles"
                    responsiveLayout="scroll"
                >
                    <template #empty>
                        <p>No hay roles</p>
                    </template>
                    <template #header>
                        <div class="flex flex-col flex-wrap justify-center">
                            <span
                                class="p-input-icon-left mx-auto mb-2 w-full sm:w-auto"
                            >
                                <i class="pi pi-search" />
                                <InputText
                                    class="w-full"
                                    type="text"
                                    v-model="filtersRoles['global'].value"
                                    placeholder="Buscar rol"
                                />
                            </span>
                            <div class="flex">
                                <InputText
                                    class="w-full"
                                    placeholder="Nombre"
                                    v-model="data.nombre_rol"
                                />
                                <InputText
                                    placeholder="Descripción"
                                    class="w-full rounded-none rounded-tl-sm rounded-bl-sm ml-2"
                                    v-model="data.descripcion_rol"
                                />
                                <button
                                    v-tooltip.top="'Crear rol'"
                                    class="disabled:bg-green-800 bg-green-500 hover:bg-green-600 text-white rounded-tr-lg rounded-br-lg px-4 py-2"
                                    @click="crearRol()"
                                >
                                    <IconoCrear />
                                </button>
                                <!-- usaremos el edit in cell
                                    <button
                                    v-tooltip.top="'Editar rol'"
                                    class="disabled:bg-gray-500 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg px-4 py-2.5"
                                    :disabled="
                                        Object.keys(data.rol ?? {}).length === 0
                                    "
                                >
                                    <IconoEditar />
                                </button> -->
                                <!-- Al solo haber delete logico, no necesitamos el boton de eliminar
                                    <button
                                    v-tooltip.top="'Eliminar rol'"
                                    class="disabled:bg-gray-500 bg-red-400 hover:bg-red-500 text-white rounded-lg px-4 py-2.5"
                                    :disabled="
                                        Object.keys(data.rol ?? {}).length === 0
                                    "
                                >
                                    <IconoEliminar />
                                </button> -->
                            </div>
                        </div>
                    </template>
                    <Column field="nombre" header="Nombre" :sortable="true">
                        <template #editor="slotProps">
                            <InputText
                                v-model="slotProps.data[slotProps.field]"
                            /> </template
                    ></Column>
                    <Column
                        field="descripcion"
                        header="Descripción"
                        :sortable="true"
                        ><template #editor="slotProps">
                            <InputText
                                v-model="slotProps.data[slotProps.field]"
                            />
                        </template>
                    </Column>
                    <Column field="estado" header="Estado" :sortable="true">
                        <template #body="slotProps">
                            <button
                                @click="delete_rol(slotProps.data['id'])"
                                :class="
                                    slotProps.data.deleted_at == null
                                        ? 'bg-green-500 p-2 rounded-lg w-fit'
                                        : 'bg-red-500 p-2 rounded-lg'
                                "
                            >
                                {{ slotProps.data.estado }}
                            </button>
                        </template>
                    </Column>
                </DataTable>
            </div>
            <!-- Ciudades -->
            <div>
                <p class="text-center text-2xl lg:mb-2 text-white">Ciudades</p>
                <DataTable
                    :value="ciudades_c"
                    :rows="10"
                    :paginator="true"
                    selectionMode="single"
                    editMode="cell"
                    @cell-edit-complete="onCellEditCiudades"
                    v-model:selection="data.ciudad"
                    v-model:filters="filtersCiudad"
                    responsiveLayout="scroll"
                >
                    <template #empty>
                        <p>No hay ciudades</p>
                    </template>
                    <template #header>
                        <div class="flex flex-col flex-wrap justify-center">
                            <span
                                class="p-input-icon-left mx-auto mb-2 w-full sm:w-auto"
                            >
                                <i class="pi pi-search" />
                                <InputText
                                    class="w-full"
                                    type="text"
                                    v-model="filtersCiudad['global'].value"
                                    placeholder="Buscar ciudad"
                                />
                            </span>
                            <div class="flex mx-auto">
                                <InputText
                                    placeholder="Nombre de la ciudad"
                                    class="w-full rounded-none rounded-tl-sm rounded-bl-sm ml-2"
                                    v-model="data.nombre_ciudad"
                                />
                                <button
                                    v-tooltip.top="'Crear ciudad'"
                                    class="disabled:bg-green-800 bg-green-500 hover:bg-green-600 text-white rounded-tr-lg rounded-br-lg px-4 py-2"
                                    @click="crearCiudad()"
                                >
                                    <IconoCrear />
                                </button>
                                <!-- usaremos el edit in cell
                                    <button
                                    v-tooltip.top="'Editar rol'"
                                    class="disabled:bg-gray-500 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg px-4 py-2.5"
                                    :disabled="
                                        Object.keys(data.rol ?? {}).length === 0
                                    "
                                >
                                    <IconoEditar />
                                </button> -->
                                <!-- Al solo haber delete logico, no necesitamos el boton de eliminar
                                    <button
                                    v-tooltip.top="'Eliminar rol'"
                                    class="disabled:bg-gray-500 bg-red-400 hover:bg-red-500 text-white rounded-lg px-4 py-2.5"
                                    :disabled="
                                        Object.keys(data.rol ?? {}).length === 0
                                    "
                                >
                                    <IconoEliminar />
                                </button> -->
                            </div>
                        </div>
                    </template>
                    <Column field="nombre" header="Nombre" :sortable="true">
                        <template #editor="slotProps">
                            <InputText
                                v-model="slotProps.data[slotProps.field]"
                            /> </template
                    ></Column>

                    <Column field="estado" header="Estado" :sortable="true">
                        <template #body="slotProps">
                            <button
                                @click="delete_ciudad(slotProps.data['id'])"
                                :class="
                                    slotProps.data.deleted_at == null
                                        ? 'bg-green-500 p-2 rounded-lg w-fit'
                                        : 'bg-red-500 p-2 rounded-lg'
                                "
                            >
                                {{ slotProps.data.estado }}
                            </button>
                        </template>
                    </Column>
                </DataTable>
            </div>
            <div>
                <p class="text-center text-2xl lg:mb-2 text-white">Marcas</p>
                <DataTable
                    :value="marcas"
                    :rows="10"
                    :paginator="true"
                    selectionMode="single"
                    editMode="cell"
                    @cell-edit-complete="onCellEditMarcas"
                    v-model:selection="data.marca"
                    v-model:filters="filtersMarca"
                    responsiveLayout="scroll"
                >
                    <template #empty>
                        <p>No hay marcas</p>
                    </template>
                    <template #header>
                        <div class="flex flex-col flex-wrap justify-center">
                            <span
                                class="p-input-icon-left mx-auto mb-2 w-full sm:w-auto"
                            >
                                <i class="pi pi-search" />
                                <InputText
                                    class="w-full"
                                    type="text"
                                    v-model="filtersMarca['global'].value"
                                    placeholder="Buscar marca"
                                />
                            </span>
                            <div class="flex mx-auto">
                                <InputText
                                    placeholder="Nombre de la marca"
                                    class="w-full rounded-none rounded-tl-sm rounded-bl-sm ml-2"
                                    v-model="data.nombre_marca"
                                />
                                <button
                                    v-tooltip.top="'Crear marca'"
                                    class="disabled:bg-green-800 bg-green-500 hover:bg-green-600 text-white rounded-tr-lg rounded-br-lg px-4 py-2"
                                    @click="crearMarca()"
                                >
                                    <IconoCrear />
                                </button>
                            </div>
                        </div>
                    </template>
                    <Column field="nombre" header="Nombre" :sortable="true">
                        <template #editor="slotProps">
                            <InputText
                                v-model="slotProps.data[slotProps.field]"
                            /> </template
                    ></Column>

                    <Column field="estado" header="Estado" :sortable="true">
                        <template #body="slotProps">
                            <button
                                @click="delete_marca(slotProps.data['id'])"
                                :class="
                                    slotProps.data.deleted_at == null
                                        ? 'bg-green-500 p-2 rounded-lg w-fit'
                                        : 'bg-red-500 p-2 rounded-lg'
                                "
                            >
                                {{
                                    slotProps.data.deleted_at == null
                                        ? "Activo"
                                        : "Inactivo"
                                }}
                            </button>
                        </template>
                    </Column>
                </DataTable>
            </div>
        </div>
    </div>
</template>
<script>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Header from "../Comun/Header.vue";
import { FilterMatchMode } from "primevue/api";
import { computed, reactive } from "vue";
import InputText from "primevue/inputtext";
import IconoCrear from "../Comun/IconoCrear.vue";
import IconoEditar from "../Comun/IconoEditar.vue";
import IconoEliminar from "../Comun/IconoEliminar.vue";
import Tooltip from "primevue/tooltip";
import { Notify } from "notiflix";
import { Inertia } from "@inertiajs/inertia";
Notify.init({
    position: "center-bottom",
    clickToClose: true,
    timeout: 3000,
});
export default {
    directives: {
        Tooltip,
    },
    components: {
        IconoCrear,
        IconoEditar,
        IconoEliminar,
        InputText,
        DataTable,
        Header,
        Column,
        Header,
    },
    props: {
        usuario: {
            type: Object,
            default: {},
        },
        roles: {
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
    },
    setup(props) {
        const filtersMarca = reactive({
            global: {
                value: "",
                matchMode: FilterMatchMode.Contains,
            },
        });
        const filtersRoles = reactive({
            global: {
                value: "",
                matchMode: FilterMatchMode.Contains,
            },
        });
        const filtersCiudad = reactive({
            global: {
                value: "",
                matchMode: FilterMatchMode.Contains,
            },
        });
        const roles_c = computed(() => {
            return props.roles.map((role) => {
                return {
                    ...role,
                    estado:
                        role.deleted_at == null
                            ? "Activo"
                            : "Inactivo desde " + role.deleted_at,
                };
            });
        });
        const ciudades_c = computed(() => {
            return props.ciudades.map((ciudad) => {
                return {
                    ...ciudad,
                    estado:
                        ciudad.deleted_at == null
                            ? "Activo"
                            : "Inactivo desde " + ciudad.deleted_at,
                };
            });
        });
        const data = reactive({
            rol: {},
            ciudad: {},
            nombre_rol: "",
            descripcion_rol: "",
            nombre_ciudad: "",
            nombre_marca: "",
        });
        const crearRol = () => {
            /* Validate lenght */
            let go = false;
            if (data.nombre_rol.length < 3) {
                Notify.error("El nombre debe tener al menos 3 caracteres");
                go = true;
            }
            if (data.descripcion_rol.length < 3) {
                Notify.error("La descripción debe tener al menos 3 caracteres");
                go = true;
            }
            if (go) return;
            /* End validate lenght */
            Inertia.post(
                route("roles_adm_create"),
                {
                    nombre: data.nombre_rol,
                    descripcion: data.descripcion_rol,
                },
                {
                    only: ["roles"],
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        Notify.success("Rol creado correctamente");
                        data.nombre_rol = "";
                        data.descripcion_rol = "";
                    },
                    onError: (errors) => {
                        for (let i in errors) {
                            Notify.failure(errors[i]);
                        }
                    },
                }
            );
        };
        const crearCiudad = () => {
            /* Validate lenght */
            if (data.nombre_ciudad.length < 3) {
                Notify.error("El nombre debe tener al menos 3 caracteres");
                return;
            }
            /* End validation */
            Inertia.post(
                route("ciudades_adm_create"),
                {
                    nombre: data.nombre_ciudad,
                },
                {
                    only: ["ciudades"],
                    onSuccess: () => {
                        Notify.success("Ciudad creada correctamente");
                        data.nombre_ciudad = "";
                    },
                    onError: (errors) => {
                        for (let i in errors) {
                            Notify.failure(errors[i]);
                        }
                    },
                }
            );
        };
        const onCellEditCiudades = (e) => {
            /* Validate lenght */

            if (e.newValue.length < 3) {
                Notify.failure("El nombre debe tener al menos 3 caracteres");
                return;
            }

            /* End validate lenght */
            Inertia.post(
                route("ciudades_adm_update"),
                {
                    id: e.data.id,
                    nombre: e.newValue,
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                    only: ["ciudades", "errors", "flash"],
                    onSuccess: () => {
                        Notify.success("Ciudad actualizada correctamente");
                    },
                    onError: (errors) => {
                        for (let i in errors) {
                            Notify.failure(errors[i]);
                        }
                    },
                }
            );
        };
        const onCellEditMarcas = (e) => {
            /* Validate lenght */

            if (e.newValue.length < 3) {
                Notify.failure("El nombre debe tener al menos 3 caracteres");
                return;
            }

            /* End validate lenght */
            Inertia.post(
                route("marcas_adm_update"),
                {
                    id: e.data.id,
                    nombre: e.newValue,
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                    only: ["marcas", "errors", "flash"],
                    onSuccess: () => {
                        Notify.success("Marca actualizada correctamente");
                    },
                    onError: (errors) => {
                        for (let i in errors) {
                            Notify.failure(errors[i]);
                        }
                    },
                }
            );
        };
        const onCellEditRoles = (e) => {
            if (e.newData.nombre.length < 3) {
                Notify.failure("El nombre debe tener al menos 3 caracteres");
                return;
            }
            if (e.newData.descripcion.length < 3) {
                Notify.failure(
                    "La descripción debe tener al menos 3 caracteres"
                );
                return;
            }

            Inertia.post(
                route("roles_adm_update"),
                {
                    id: e.newData.id,
                    nombre: e.newData.nombre,
                    descripcion: e.newData.descripcion,
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                    only: ["roles", "errors"],
                    onSuccess: () => {
                        Notify.success("Rol actualizado correctamente");
                    },
                    onError: (errors) => {
                        for (let i in errors) {
                            Notify.failure(errors[i]);
                        }
                    },
                }
            );
        };
        const delete_rol = (id) => {
            Inertia.post(
                route("roles_adm_delete"),
                {
                    id,
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                    only: ["roles", "errors", "flash"],
                    onSuccess: (success) => {
                        Notify.success(success.props.flash.success.message);
                    },
                    onError: (errors) => {
                        for (let i in errors) {
                            Notify.failure(errors[i]);
                        }
                    },
                }
            );
        };
        const delete_ciudad = (id) => {
            Inertia.post(
                route("ciudades_adm_delete"),
                {
                    id,
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                    only: ["ciudades", "errors", "flash"],
                    onSuccess: (success) => {
                        Notify.success(success.props.flash.success.message);
                    },
                    onError: (errors) => {
                        for (let i in errors) {
                            Notify.failure(errors[i]);
                        }
                    },
                }
            );
        };
        const crearMarca = () => {
            /* Validate lenght */
            if (data.nombre_marca.length < 3) {
                Notify.failure("El nombre debe tener al menos 3 caracteres");
                return;
            }
            /* End validation */
            Inertia.post(
                route("marcas_adm_create"),
                {
                    nombre: data.nombre_marca,
                },
                {
                    only: ["marcas", "errors", "flash"],
                    onSuccess: () => {
                        Notify.success("Marca creada correctamente");
                        data.nombre_marca = "";
                    },
                    onError: (errors) => {
                        for (let i in errors) {
                            Notify.failure(errors[i]);
                        }
                    },
                }
            );
        };
        const delete_marca = (id) => {
            Inertia.post(
                route("marcas_adm_delete"),
                {
                    id,
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                    only: ["marcas", "errors", "flash"],
                    onSuccess: (success) => {
                        Notify.success(success.props.flash.success);
                    },
                    onError: (errors) => {
                        for (let i in errors) {
                            Notify.failure(errors[i]);
                        }
                    },
                }
            );
        };
        return {
            delete_marca,
            crearMarca,
            onCellEditMarcas,
            filtersMarca,
            crearCiudad,
            delete_ciudad,
            onCellEditCiudades,
            filtersCiudad,
            ciudades_c,
            delete_rol,
            onCellEditRoles,
            crearRol,
            data,
            roles_c,
            filtersRoles,
        };
    },
};
</script>

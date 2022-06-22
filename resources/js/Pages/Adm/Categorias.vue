<template>
    <Header :usuario="usuario" />
    <div class="flex">
        <div class="mx-auto">
            <p class="text-white text-2xl">Lista de categorias</p>
        </div>
    </div>
    <div class="w-11/12 ml-auto mr-auto mt-2">
        <div class="flex">
            <div class="ml-auto">
                <button class="px-2 py-2 m-1 bg-green-500 text-white rounded-lg"
                    v-tooltip.bottom="'Agregar característica'"
                    @click="valores.showModalCrearPosibleCat = !valores.showModalCrearPosibleCat">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" class="w-6 h-6" viewBox="0 0 16 16">
                        <path
                            d="M8 0a1 1 0 0 1 1 1v5.268l4.562-2.634a1 1 0 1 1 1 1.732L10 8l4.562 2.634a1 1 0 1 1-1 1.732L9 9.732V15a1 1 0 1 1-2 0V9.732l-4.562 2.634a1 1 0 1 1-1-1.732L6 8 1.438 5.366a1 1 0 0 1 1-1.732L7 6.268V1a1 1 0 0 1 1-1z" />
                    </svg>
                </button>
                <button class="px-2 py-2 m-1 bg-green-500 text-white rounded-lg" v-tooltip.bottom="'Agregar categoría'"
                    @click="(valores.showModal = !valores.showModal),
                    (valores.accion = 'Agregar'),
                    (valores.nombre = ''),
                    (valores.descripcion = '')">
                    <svg class="w-6 h-6" fill="none" stroke="white" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </button>
                <button v-tooltip.bottom="'Editar categoría'"
                    class="px-2 py-2 m-1 disabled:bg-gray-500 bg-yellow-500 text-white rounded-lg"
                    :disabled="categoria_seleccionada.id ? false : true" @click="
                    (valores.showModal = !valores.showModal),
                    (valores.accion = 'Editar'),
                    (valores.nombre = categoria_seleccionada.nombre),
                    (valores.descripcion = categoria_seleccionada.descripcion)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-6 h-6" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                </button>
                <button v-tooltip.bottom="'Borrar categoría'" @click="deleteCat()"
                    class="px-2 py-2 m-1 bg-red-500 text-white rounded-lg disabled:bg-gray-500"
                    :disabled="categoria_seleccionada.id ? false : true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-6 h-6" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm.66 11.34L3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z" />
                    </svg>
                </button>
                <button class="p-2 m-1 bg-blue-500 text-white rounded-lg disabled:bg-gray-500"
                    :disabled="categoria_seleccionada.id ? false : true"
                    @click="(valores.modal_detalles = !valores.modal_detalles), cargarLista()"
                    v-tooltip.bottom="'Asignar característica a categoría'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="w-6 h-6" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                    </svg>
                </button>
            </div>
        </div>
        <Tree class="overflow-x-scroll overflow-y-scroll mt-1" style="max-height: 70vh; max-width: 92vw"
            :value="categorias_tratadas" :expandedKeys="expandedKeys" selectionMode="single"
            v-model:selectionKeys="categoria_seleccionada_keys" @node-select="onNodeSelect"
            @node-unselect="onNodeUnselect" :filter="true" filterMode="lenient" styleClass="w-full">
        </Tree>
    </div>
    <Dialog :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }" :modal="true" :header="
        (valores.accion == 'Agregar' ? 'Agregar Categoria' : 'Editar Categoria') +
        ' en ' +
        (categoria_seleccionada.id ? categoria_seleccionada.nombre : 'raiz')
    " v-model:visible="valores.showModal">
        <form @submit.prevent="crear">
            <div class="grid xl:grid-cols-2 xl:gap-6 mt-2">
                <div class="col-span-1">
                    <label for="nombre" class="block text-sm font-medium leading-5 text-white">
                        Nombre *
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <InputText class="w-full" placeholder="Nombre (Requerido)" v-model="valores.nombre">
                        </InputText>
                    </div>
                </div>
                <div class="col-span-1">
                    <label for="descripcion" class="block text-sm font-medium leading-5 text-white">
                        Descripción
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <InputText placeholder="Descripción (Opcional)" class="w-full" v-model="valores.descripcion" />
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <span class="inline-flex rounded-md shadow-sm">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        {{ valores.accion }}
                    </button>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="button"
                        class="inline-flex justify-center py-2 px-4 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                        @click="valores.showModal = false">
                        Cancelar
                    </button>
                </span>
            </div>
        </form>
    </Dialog>

    <Dialog :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }" :modal="true" :header="
        'Posibles características de la categoría ' + `'${categoria_seleccionada.nombre}'`
    " v-model:visible="valores.modal_detalles">
        <DataTable :value="caracteristicas_c">
            <template #header>
                <div class="flex flex-row gap-2 justify-center">
                    <MultiSelect :filter="true" class="basis-3/4 max-w-xs md:max-w-md"
                        placeholder="Selecciona una o más posibles características" :options="posibles_c"
                        optionLabel="label" v-model="valores.tipo_seleccionado" />
                    <button class="bg-green-500 p-2 rounded-lg text-white basis-1/4"
                        @click="sincronizarCaracteristicas()">
                        Agregar
                    </button>
                </div>
            </template>
            <Column header="Nombre" field="nombre"> </Column>
            <Column header="Descripción" field="descripcion"> </Column>

            <Column header="Unidad de medida" field="unidad_medida"> </Column>
        </DataTable>
    </Dialog>
    <Dialog :breakpoints="{ '960px': '75vw', '640px': '100vw' }" :style="{ width: '50vw' }" :modal="true"
        v-model:visible="valores.showModalCrearPosibleCat">
        <template #header>
            <a class="text-white text-2xl">Lista de caracteristicas</a>
            <InputText v-model="filterPC['global'].value" placeholder="Buscar" />
        </template>
        <DataTable :value="posibles_caracteristicas" selectionMode="single" editMode="cell"
            @cell-edit-complete="editarCaracteristica" v-model:selection="posibleSeleccionado"
            v-model:filters="filterPC" :rows="10" :paginator="true">
            <template #empty>
                <p>No hay características, crea una!</p>
            </template>
            <template #header>
                <form @submit.prevent="crearCaracteristica" class="gap-2 flex flex-col md:flex-row">
                    <div class="w-full">
                        <p>Nombre*</p>
                        <InputText class="w-full" v-model="valoresCaracteristicas.nombre" placeholder="Nombre">
                        </InputText>
                    </div>
                    <div class="w-full">
                        <p>Descripción*</p>
                        <InputText class="w-full" v-model="valoresCaracteristicas.descripcion"
                            placeholder="Descripción"></InputText>
                    </div>
                    <div class="w-full">
                        <div>
                            <p>Unidad de medida</p>
                            <div class="flex flex-inline flex-row">
                                <InputText class="w-full" v-model="valoresCaracteristicas.unidad_medida"
                                    placeholder="No es obligatorio" />
                                <button class="bg-green-500 text-white p-1.5 rounded--lg rounded-tr-lg rounded-br-lg"
                                    type="submit">
                                    Crear
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </template>
            <Column header="Nombre" field="nombre">
                <template #editor="slotProps">
                    <InputText v-model="slotProps.data[slotProps.field]" />
                </template>
            </Column>
            <Column header="Descripción" field="descripcion">
                <template #editor="slotProps">
                    <InputText v-model="slotProps.data[slotProps.field]" />
                </template>
            </Column>
            <Column header="Unidad de medida" field="unidad_medida">
                <template #body="slotProps">
                    {{
                            slotProps.data[slotProps.field] == null
                                ? "Booleano"
                                : slotProps.data[slotProps.field]
                    }}
                </template>
                <template #editor="slotProps">
                    <InputText v-model="slotProps.data[slotProps.field]" />
                </template>
            </Column>
            <Column><template #body="slotProps">
                    <button class="bg-red-500 p-2 rounded-lg self-center"
                        @click="eliminarCaracteristica(slotProps.data.id)">
                        <IconoEliminar />
                    </button>
                </template>
            </Column>
        </DataTable>
        <template #footer> </template>
    </Dialog>
</template>

<script>
import Header from "../Comun/Header.vue";
import Tree from "primevue/tree";
import { FilterMatchMode } from "primevue/api";
//Dialog from primevue
import Dialog from "primevue/dialog";
import { Inertia } from "@inertiajs/inertia";
import { Confirm, Notify, Loading } from "notiflix";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputText from "primevue/inputtext";
import MultiSelect from "primevue/multiselect";
import IconoCrear from "../Comun/IconoCrear.vue";
import IconoEditar from "../Comun/IconoEditar.vue";
import IconoEliminar from "../Comun/IconoEliminar.vue";
import Dropdown from "primevue/dropdown";
import Tooltip from "primevue/tooltip";

Confirm.init({
    titleColor: "#FF0000",
    messageColor: "#FF0000",
    okButtonBackground: "#FF0000",
});
Notify.init({
    position: "center-bottom",
    clickToClose: true,
    timeout: 3000,
});
//Confirm
export default {
    directives: {
        Tooltip,
    },
    props: ["categorias", "usuario", "errors", "posibles_caracteristicas"],
    components: {
        Dropdown,
        IconoCrear,
        IconoEditar,
        IconoEliminar,
        Tree,
        Header,
        Dialog,
        DataTable,
        Column,
        InputText,
        MultiSelect,
    },
    computed: {
        posibles_c() {
            return this.posibles_caracteristicas.map((val) => {
                return {
                    label: `${val.nombre} - [${val.descripcion}]`,
                    value: val.id,
                    ...val,
                };
            });
        },
        caracteristicas_c() {
            return this.categoria_seleccionada.posibles_caracteristicas;
        },
    },

    data() {
        return {
            filterPC: {
                global: {
                    value: "",
                    matchMode: FilterMatchMode.Contains,
                },
            },
            eliminarCaracteristica: (id) => {
                Confirm.show(
                    "¿Está seguro de eliminar esta característica?",
                    "Eliminaras la característica",
                    "Ok",
                    "Cancelar",

                    () => {
                        Inertia.post(
                            route("caracteristicas_adm_delete"),
                            {
                                id: id,
                            },
                            {
                                onSuccess: (success) => {
                                    Notify.success(success.props.flash.success);
                                },
                                onError: (error) => {
                                    for (let i in error) {
                                        Notify.failure(error[i]);
                                    }
                                },
                            }
                        );
                    }
                );
            },
            editarCaracteristica: (e) => {
                if (e.newValue.length < 3) {
                    Notify.warning("El campo no puede ser menor a 3");
                    return;
                }
                Inertia.post(
                    route("caracteristicas_adm_update"),

                    e.newData,
                    {
                        onSuccess: (success) => {
                            Notify.success(success.props.flash.success);
                        },
                        onError: (error) => {
                            for (let i in error) {
                                Notify.failure(error[i]);
                            }
                        },
                    }
                );
            },
            crearCaracteristica: () => {
                /* Validar datos de descripción y nombre */
                if (
                    this.valoresCaracteristicas.nombre.length < 1 ||
                    this.valoresCaracteristicas.descripcion.length < 1
                ) {
                    Notify.warning("Debes agregar un nombre, característica y una descripción");
                    return;
                }
                Inertia.post(route("caracteristicas_adm_create"), this.valoresCaracteristicas, {
                    onSuccess: (success) => {
                        Notify.success("Creado correctamente");
                    },
                    onError: (error) => {
                        for (let i in error) {
                            Notify.failure(error[i]);
                        }
                    },
                });
            },

            categorias_tratadas: [],
            expandedKeys: {},
            categoria_seleccionada: {},
            categoria_seleccionada_keys: {},
            valores: {
                showModal: false,
                showModalCrearPosibleCat: false,
                accion: "Agregar",
                nombre: "",
                modal_detalles: false,
                descripcion: "",
                tipo_seleccionado: "",
            },
            posibleSeleccionado: {},
            valoresCaracteristicas: {
                nombre: "",
                descripcion: "",
                unidad_medida: "",
            },
        };
    },
    mounted() {
        this.crearArbol();
    },
    methods: {
        cargarLista() {
            console.log("lista", this.categoria_seleccionada.posibles_caracteristicas);
            console.log("c", this.posibles_caracteristicas);
            let lista = this.posibles_caracteristicas
                .filter((item) => {
                    return this.categoria_seleccionada.posibles_caracteristicas.some(
                        (caracteristica) => {
                            return item.id == caracteristica.id;
                        }
                    );
                })
                .map((item) => {
                    return {
                        label: `${item.nombre} - [${item.descripcion}]`,
                        value: item.id,
                        ...item,
                    };
                });
            console.log(lista);
            this.valores.tipo_seleccionado = lista;
            console.log(this.valores.tipo_seleccionado);
        },
        sincronizarCaracteristicas() {
            Inertia.post(
                route("sincronizar_categoria_posible"),
                {
                    id: this.categoria_seleccionada.id,
                    valores: this.valores.tipo_seleccionado.map((val) => val.value),
                },
                {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () => {
                        Notify.success("Características asignadas");
                        /* Sincronizar la categoría seleccionada con los nuevos datos */
                        this.categoria_seleccionada = this.categorias.find((categoria) => {
                            return categoria.id == this.categoria_seleccionada.id;
                        });
                        /* Ocultar modal */

                        this.valores.modal_detalles = false;
                    },
                }
            );
        },
        deleteCat() {
            Confirm.show(
                `¿Estas seguro de eliminar la categoria ${this.categoria_seleccionada.nombre}?`,
                "Estás a punto de eliminar una categoria",
                "Eliminar",
                "Cancelar",
                () => {
                    Loading.standard({
                        clickToClose: false,
                        svgSize: "200",
                    });
                    Inertia.post(
                        route("categorias_adm_delete"),
                        {
                            id: this.categoria_seleccionada.id,
                        },
                        {
                            preserveScroll: true,
                            preserveState: true,
                            errorBag: this.errorBag,
                            onSuccess: () => {
                                this.crearArbol();
                                Notify.success("Categoria eliminada");
                                Loading.remove();
                            },
                            onError: () => {
                                Notify.failure(this.errors.message);
                                Loading.remove();
                            },
                        }
                    );
                }
            );
        },
        validar() {
            if (this.valores.nombre.length < 3) {
                Notify.failure("El nombre debe tener al menos 3 caracteres");
                return false;
            }
            if (this.valores.descripcion < 3) {
                Notify.failure("La descripción debe tener al menos 3 caracteres");
                return false;
            }
            return true;
        },
        crearCategoria() {
            Inertia.post(
                route("categorias_adm_create"),
                {
                    nombre: this.valores.nombre,
                    descripcion: this.valores.descripcion,
                    id_categoria_padre: this.categoria_seleccionada.id,
                },
                {
                    only: ["categorias", "errors", "flash"],
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.valores.showModal = false;
                        this.crearArbol();
                        this.valores.nombre = "";
                        this.valores.descripcion = "";
                        this.categoria_seleccionada = {};
                        this.categoria_seleccionada_keys = {};
                        Notify.success(response.props.flash.success.message);
                    },
                    onError: (response) => {
                        this.valores.showModal = false;
                        for (let message in response) {
                            Notify.failure(response[message]);
                        }
                    },
                }
            );
        },
        editarCategoria() {
            Inertia.post(
                route("categorias_adm_update"),
                {
                    id: this.categoria_seleccionada.id,
                    nombre: this.valores.nombre,
                    descripcion: this.valores.descripcion,
                },
                {
                    only: ["categorias", "errors", "flash"],
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.valores.showModal = false;
                        this.crearArbol();
                        this.valores.nombre = "";
                        this.valores.descripcion = "";
                        this.categoria_seleccionada = {};
                        this.categoria_seleccionada_keys = {};
                        Notify.success(response.props.flash.success.message);
                    },
                    onError: (response) => {
                        this.valores.showModal = false;
                        for (let message in response) {
                            Notify.failure(response[message]);
                        }
                    },
                }
            );
        },
        crear() {
            if (this.valores.accion == "Agregar") {
                this.crearCategoria();
            } else {
                this.editarCategoria();
            }
        },
        onNodeUnselect(e) {
            this.categoria_seleccionada_keys = {};
        },
        onNodeSelect(e) {
            this.categoria_seleccionada = e;
            this.categoria_seleccionada_keys = e;
        },
        expandAll() {
            for (let node in this.categorias_tratadas) {
                this.expandNode(this.categorias_tratadas[node]);
            }
            this.expandedKeys = { ...this.expandedKeys };
        },
        expandNode(node) {
            this.expandedKeys[node.key] = true;
            if (node.children && node.children.length) {
                for (let child of node.children) {
                    this.expandNode(child);
                }
            }
        },
        crearArbol() {
            /* Complexity to the moon */
            let arrayToTree = (array) => {
                //Asignamos la key a cada nodo, que será el ID de la categoria
                //Además, le ponemos el label que será el nombre de esta categoria.
                array.forEach((node) => {
                    node.key = node.id;
                    node.label = node.nombre;
                });
                //Creamos una función que nos devuelva el indice del padre de un nodo
                let findParentIndex = (id_parent) => {
                    return array.findIndex((node) => node.id == id_parent);
                };
                //Si todos los parents son null retorna true
                let allParentsNull = (arr) => {
                    return arr.find((node) => {
                        return node.id_categoria_padre != null;
                    });
                };
                let hasChildren = (id) => {
                    return array.find((node) => node.id_categoria_padre == id);
                };
                let check = allParentsNull(array);
                let count = 0;
                // Mientras haya nodos sin padre o hayan 1000 iteracionesç

                while (check) {
                    //Recorremos el array
                    for (let i = 0; i < array.length; i++) {
                        //Si el nodo tiene padre
                        if (array[i].id_categoria_padre != null) {
                            //Si el nodo tiene hijos, no lo acomodamos aún, pero si tiene, si
                            if (hasChildren(array[i].id) == undefined) {
                                //Como no tiene hijos, lo acomodamos, primero necesitamos a su padre
                                let indexParent = findParentIndex(array[i].id_categoria_padre);

                                //Si el padre no existe, no lo acomodamos, es un nodo raiz, pero si tiene padre
                                // lo pusheamos a su padre

                                if (indexParent != -1) {
                                    let padre = array[indexParent];

                                    //Le creamos una propiedad hijos, que será un array vacío
                                    if (!padre.children) {
                                        padre.children = [];
                                    }
                                    //Y lo metemos finalmente

                                    padre.children.push(array[i]);
                                }
                                //Finalmente, eliminamos el nodo del array

                                array.splice(i, 1);
                            }
                        }
                    }

                    check = allParentsNull(array);

                    count++;
                    if (count > 100) {
                        break;
                    }
                }
                console.log("Terminado en ", count, " iteraciones");
                let tree = [
                    {
                        label: "Categorias",
                        children: array,
                    },
                ];
                return tree;
            };
            //Assign porque proxy prop no es editable

            this.categorias_tratadas = arrayToTree(Object.assign(this.categorias));
            this.expandAll();
            //Expand all
        },
    },
};
</script>

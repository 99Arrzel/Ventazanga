<template>
    <TreeSelect v-model="data.seleccionado" :options="categorias_c" selectionMode="single" class="w-full"
        placeholder="Selecciona una categoría" @node-select="emitCambio" @node-unselect="emitNull">

    </TreeSelect>
</template>
<script>
import TreeSelect from 'primevue/treeselect';
import { reactive, computed } from "@vue/reactivity";
export default {
    components: {
        TreeSelect,
    },
    props: {
        categorias: {
            type: Array,
            required: true,
        },
    },
    setup(props, { emit }) {
        const emitCambio = (e) => {

            /* Nos devuelve un proxy que contiene el id */
            emit('cambio', e);
        }
        const emitNull = (e) => {

            emit('cambio', null);
        }
        const data = reactive({
            seleccionado: null,
        });
        const categorias_c = computed(() => {

            return crearArbol(props.categorias);
        })
        /* Arbol algo */
        const crearArbol = (lasCat) => {
            /* Estoy cansado de copiar y que el id esté mal, ahora definiremos eso */

            let arrayToTree = (array) => {

                array.forEach((node) => {
                    node.key = node.id;
                    node.label = node.nombre
                });

                let findParentIndex = (id_categoria_padre) => {
                    return array.findIndex(
                        (node) => node.id == id_categoria_padre
                    );
                };

                let allParentsNull = (arr) => {
                    return arr.find((node) => {
                        return node.id_categoria_padre != null;
                    });
                };
                let hasChildren = (id) => {
                    return array.find((node) => node.id_categoria_padre == id);
                };
                let check = allParentsNull(array);

                /* Ignore here for filter */
                let count = 0;
                while (check) {
                    for (let i = 0; i < array.length; i++) {
                        if (array[i].id_categoria_padre != null) {
                            if (hasChildren(array[i].id) == undefined) {
                                let indexParent = findParentIndex(
                                    array[i].id_categoria_padre
                                );

                                if (indexParent != -1) {
                                    let padre = array[indexParent];

                                    if (!padre.children) {
                                        padre.children = [];
                                    }

                                    padre.children.push(array[i]);
                                }
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

                //console.log("Terminado en ", count, " iteraciones", array);
                return [
                    ...array,
                ];
            };
            //Assign porque proxy prop no es editable

            return arrayToTree([...lasCat]);
            //Expand all
        };

        return { data, categorias_c, emitCambio, emitNull };
    },
};
</script>

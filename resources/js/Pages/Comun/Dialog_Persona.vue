<template>
    <!-- m-1 text-base bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded -->
    <button
        :disabled="disabled_button"
        :class="button_class"
        @click="(datos.visible = !datos.visible), cargar()"
    >
        {{ button_text }}
    </button>
    <Dialog
        :breakpoints="{ '960px': '75vw', '640px': '100vw' }"
        :style="{ width: '50vw' }"
        :modal="true"
        :header="accion == 'Agregar' ? 'Agregar Persona' : 'Editar Persona'"
        v-model:visible="datos.visible"
    >
        <form @submit.prevent="submit">
            <div class="grid xl:grid-cols-2 xl:gap-6 my-2">
                <div>
                    <p>Nombre *</p>
                    <InputText
                        v-model="datos.nombre"
                        placeholder="Nombre"
                        class="w-full"
                    ></InputText>
                </div>
                <div>
                    <p>Apellido Paterno*</p>
                    <InputText
                        v-model="datos.apellido_p"
                        placeholder="Apellido paterno"
                        class="w-full"
                    ></InputText>
                </div>
                <div>
                    <p>Apellido Materno*</p>
                    <InputText
                        v-model="datos.apellido_m"
                        placeholder="Apellido materno"
                        class="w-full"
                    ></InputText>
                </div>
                <div>
                    <p>Cédula de identidad *</p>
                    <InputText
                        v-model="datos.ci"
                        placeholder="Cédula de identidad"
                        class="w-full"
                        type="number"
                    ></InputText>
                </div>
                <div>
                    <p>Correo *</p>
                    <InputText
                        v-model="datos.email"
                        placeholder="email electrónico"
                        class="w-full"
                        type="email"
                    ></InputText>
                </div>
                <div>
                    <p>Dirección *</p>
                    <InputText
                        v-model="datos.direccion"
                        placeholder="Dirección "
                        class="w-full"
                        type="text"
                    ></InputText>
                </div>
                <div>
                    <p>Teléfono *</p>
                    <InputText
                        v-model="datos.telefono"
                        placeholder="Teléfono "
                        class="w-full"
                        type="number"
                    ></InputText>
                </div>
                <div>
                    <p>Ciudad *</p>
                    <Dropdown
                        v-model="datos.ciudad"
                        :options="ciudades_c"
                        optionLabel="label"
                        placeholder="Seleccione una ciudad"
                        class="w-full"
                        type="text"
                    ></Dropdown>
                </div>
            </div>
            <Button
                :class="
                    accion == 'Agregar'
                        ? 'p-button-success'
                        : 'p-button-warning'
                "
                type="submit"
                :label="accion == 'Agregar' ? 'Crear' : 'Editar'"
            ></Button>
        </form>
    </Dialog>
</template>
<script>
import Dialog from "primevue/dialog";
import InputText from "primevue/inputtext";
import Dropdown from "primevue/dropdown";
import { Notify } from "notiflix";
import Button from "primevue/button";

import { computed, reactive, watch } from "@vue/runtime-core";
//Set position and click to close
Notify.init({
    position: "center-bottom",
    clickToClose: true,
    timeout: 3000,
});
export default {
    props: {
        ciudades: {
            type: Array,
            default: [],
        },
        button_text: {
            type: String,
            default: "Agregar",
        },
        button_class: {
            type: String,
            default:
                "bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded",
        },
        persona: {
            type: Object,
            default: null,
        },
        accion: {
            type: String,
            default: "Agregar",
        },
        disabled_button: {
            type: Boolean,
            default: false,
        },
    },
    components: {
        InputText,
        Dialog,
        Dropdown,
        Button,
    },
    //Emits
    emits: ["actualizarPersonas", "cargarCiudades"],
    setup(props, { emit }) {
        watch(
            () => props.ciudades,
            (val) => {
                if (val != null && props.persona != null) {
                    datos.nombre = props.persona.nombre;
                    datos.apellido_p = props.persona.apellido_p;
                    datos.apellido_m = props.persona.apellido_m;
                    datos.ci = props.persona.ci;
                    datos.email = props.persona.email;
                    datos.direccion = props.persona.direccion;
                    datos.telefono = props.persona.telefono;
                    //Calculate id
                    datos.ciudad = ciudades_c.value.find(
                        (ciudad) => ciudad.label == props.persona.ciudad
                    );
                }
            }
        );

        const cargar = () => {
            emit("cargarCiudades");
            console.log("Emitido ");
        };
        const ciudades_c = computed(() => {
            return props.ciudades.map((ciudad) => {
                return {
                    label: ciudad.nombre,
                    value: ciudad.id,
                };
            });
        });
        const datos = reactive({
            nombre: "",
            apellido_p: "",
            apellido_m: "",
            ci: "",
            direccion: "",
            email: "",
            telefono: "",
            ciudad: "",
            visible: false,
            prevent_submit: false,
        });
        const validate = () => {
            if (datos.nombre.length < 3) {
                Notify.failure("El nombre debe tener al menos 3 caracteres", {
                    position: "center-bottom",
                    timeout: 3000,
                    width: "350px",
                });
                return false;
            }
            if (datos.apellido_p.length < 3) {
                Notify.failure(
                    "El apellido paterno debe tener al menos 3 caracteres",
                    {
                        position: "center-bottom",
                        timeout: 3000,
                        width: "350px",
                    }
                );
                return false;
            }
            if (datos.apellido_m.length < 3) {
                Notify.failure(
                    "El apellido materno debe tener al menos 3 caracteres",
                    {
                        position: "center-bottom",
                        timeout: 3000,
                        width: "350px",
                    }
                );
                return false;
            }
            if (datos.ci.length < 6) {
                Notify.failure(
                    "La cédula de identidad debe tener al menos 6 caracteres",
                    {
                        position: "center-bottom",
                        timeout: 3000,
                        width: "350px",
                    }
                );
                return false;
            }
            if (datos.direccion.length < 3) {
                Notify.failure(
                    "La dirección debe tener al menos 5 caracteres",
                    {
                        position: "center-bottom",
                        timeout: 3000,
                        width: "350px",
                    }
                );
                return false;
            }
            if (datos.ciudad.value == null || datos.ciudad.value == "") {
                Notify.failure("Selecciona una ciudad", {
                    position: "center-bottom",
                    timeout: 3000,
                    width: "350px",
                });
                return false;
            }
            return true;
        };
        const submit = () => {
            if (!validate()) return;
            let data = {
                id: props.persona != null ? props.persona.id : null,
                nombre: datos.nombre,
                apellido_p: datos.apellido_p,
                apellido_m: datos.apellido_m,
                ci: datos.ci,
                telefono: datos.telefono,
                direccion: datos.direccion,
                email: datos.email,
                id_ciudad: datos.ciudad.value,
                accion: props.accion,
            };

            emit("actualizarPersonas", data);
            datos.visible = false;
        };

        return {
            cargar,
            submit,
            ciudades_c,
            datos,
        };
    },
};
</script>

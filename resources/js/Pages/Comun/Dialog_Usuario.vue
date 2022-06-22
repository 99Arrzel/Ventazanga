<template>
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
        :header="accion == 'Agregar' ? 'Agregar usuario' : 'Editar usuario'"
        v-model:visible="datos.visible"
    >
        <form @submit.prevent="submit">
            <div class="grid xl:grid-cols-2 xl:gap-6 my-2">
                <div>
                    <p>Usuario *</p>
                    <InputText
                        v-model="datos.usuario"
                        placeholder="Nombre"
                        class="w-full"
                    ></InputText>
                </div>
                <div>
                    <p>Password</p>
                    <InputText
                        v-model="datos.password"
                        :placeholder="
                            accion == 'Agregar'
                                ? 'Password (Requerido)'
                                : 'Nueva password (Opcional)'
                        "
                        class="w-full"
                        type="password"
                    ></InputText>
                </div>
                <div>
                    <p>Rol *</p>
                    <Dropdown
                        v-model="datos.rol"
                        :options="roles_c"
                        optionLabel="label"
                        placeholder="Seleccione un rol"
                        class="w-full"
                        type="text"
                    >
                    </Dropdown>
                </div>
                <div>
                    <p>Persona *</p>
                    <Dropdown
                        v-model="datos.persona"
                        :options="personas_c"
                        optionLabel="label"
                        placeholder="Seleccione una persona"
                        class="w-full"
                        type="text"
                        :filter="true"
                    >
                    </Dropdown>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" :class="button_class">
                    {{ accion }}
                </button>
            </div>
        </form>
    </Dialog>
</template>
<script>
import Dialog from "primevue/dialog";
import InputText from "primevue/inputtext";
import Dropdown from "primevue/dropdown";
import { Notify } from "notiflix";
import { reactive, computed, watch } from "vue";
Notify.init({
    position: "center-bottom",
    clickToClose: true,
    timeout: 3000,
});
export default {
    components: { Dialog, InputText, Dropdown },
    props: {
        roles: {
            type: Array,
            default: [],
        },
        personas: {
            type: Array,
            default: [],
        },
        usuario: {
            type: Object,
            default: {},
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
        accion: {
            type: String,
            default: "Agregar",
        },
        disabled_button: {
            type: Boolean,
            default: false,
        },
    },
    //Emits
    emits: ["cargarRoles", "actualizarUsuario"],
    setup(props, { emit }) {
        watch(
            () => props.roles,
            (newVal) => {
                if (newVal != null && props.usuario != {}) {
                    console.log(roles_c.value);
                    console.log(props.usuario);
                    //Set user data
                    datos.usuario = props.usuario.usuario;
                    datos.rol = roles_c.value.find(
                        (rol) => rol.label == props.usuario.nombre_rol
                    );
                    datos.persona = personas_c.value.find((persona) =>
                        persona.label.includes(props.usuario.nombre)
                    );
                    datos.password = "";
                }
            }
        );
        const personas_c = computed({
            get() {
                return props.personas.map((persona) => {
                    return {
                        value: persona.id,
                        label:
                            persona.nombre +
                            " " +
                            persona.apellido_p +
                            " - " +
                            persona.ci,
                    };
                });
            },
        });
        const roles_c = computed({
            get() {
                return props.roles.map((rol) => {
                    return {
                        value: rol.id,
                        label: rol.nombre,
                    };
                });
            },
        });
        const cargar = () => {
            emit("cargarRoles");
        };
        const datos = reactive({
            visible: false,
            usuario: null,
            password: null,
            rol: null,
            persona: null,
        });
        const submit = () => {
            if (
                datos.usuario == null ||
                datos.usuario == "" ||
                datos.usuario < 3
            ) {
                Notify.failure("Debe ingresar un usuario");
                return;
            }
            if (
                (datos.password == null ||
                    datos.password == "" ||
                    datos.password.length < 6) &&
                props.accion == "Agregar"
            ) {
                Notify.failure("Debe ingresar un password de 6 carácteres");
                return;
            }
            if (
                props.accion == "Editar" &&
                datos.password != "" &&
                datos.password.length < 6
            ) {
                Notify.failure(
                    "Debe ingresar un password de 6 carácteres al editar"
                );
                return;
            }
            if (datos.rol == null || datos.rol == "") {
                Notify.failure("Debe seleccionar un rol");
                return;
            }
            if (datos.persona == null || datos.persona == "") {
                Notify.failure("Debe seleccionar una persona");
                return;
            }
            emit("actualizarUsuario", {
                id: props.usuario.id,
                usuario: datos.usuario,
                password: datos.password,
                id_rol: datos.rol.value,
                id_persona: datos.persona.value,
                accion: props.accion,
            });
            //Clear all

            datos.visible = false;
        };
        return {
            submit,
            cargar,
            personas_c,
            roles_c,
            datos,
        };
    },
};
</script>

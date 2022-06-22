<template >
    <Header> </Header>

    <div class="flex items-center justify-center" style="min-height: 90vh">
        <form @submit.prevent="registro" class="p-12 bg-white rounded-2xl w-100">
            <div class="mb-4">
                <h3 class="font-semibold text-2xl text-gray-800">
                    Registrate en Ventazan.ga
                </h3>
            </div>
            <div class="grid md:grid-cols-2 gap-2">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 tracking-wide">Usuario*</label>
                    <input required autocomplete="username"
                        class="w-full text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                        type="text" placeholder="Ingrese un usuario" v-model="data.usuario" />
                </div>
                <div class="space-y-2">
                    <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                        Contraseña*
                    </label>
                    <input required
                        class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                        type="password" autocomplete="new-password" placeholder="Ingrese su contraseña"
                        v-model="data.password" />
                </div>
                <div class="space-y-2">
                    <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                        Repite la contraseña*
                    </label>
                    <input required
                        class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                        type="password" autocomplete="new-password" placeholder="Repita su contraseña"
                        v-model="data.password_confirmation" />
                </div>


                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 tracking-wide">Nombre*</label>
                    <input required
                        class="w-full text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                        type="text" placeholder="Ingrese su nombre" v-model="data.nombre" />
                </div>
                <div class="space-y-2">
                    <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                        Apellido paterno*
                    </label>
                    <input required
                        class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                        type="text" placeholder="Ingrese su apellido paterno" v-model="data.apellido_p" />
                </div>
                <div class="space-y-2">
                    <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                        Apellido Materno
                    </label>
                    <input required
                        class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                        type="text" placeholder="Ingrese su apellido materno" v-model="data.apellido_m" />
                </div>
                <div class="space-y-2">
                    <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                        Correo*
                    </label>
                    <input required
                        class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                        type="email" placeholder="Ingrese su correo electrónico" v-model="data.email" />
                </div>
                <div class="space-y-2">
                    <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                        Cédula de identidad*
                    </label>
                    <input required min="500000" max="99999999"
                        class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                        type="number" placeholder="Ingrese su CI" v-model="data.ci" />
                </div>
                <div class="space-y-2">
                    <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                        Teléfono*
                    </label>
                    <input required min="100000" max="99999999"
                        class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                        type="number" placeholder="Ingrese su número de teléfono" v-model="data.telefono" />
                </div>
                <div class="space-y-2">
                    <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                        Ciudad*
                    </label>
                    <select required
                        class="w-full content-center text-base px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-green-400"
                        v-model="data.ciudad">
                        <option value="" disabled selected hidden>Seleccione una ciudad</option>
                        <option v-for="ciudad in ciudades" :value="ciudad.id">
                            {{ ciudad.nombre }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-between mt-2">

                <button type="submit"
                    class="w-full flex justify-center bg-red-400 hover:bg-red-500 text-gray-100 p-3 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
                    Registrarse
                </button>
            </div>
        </form>
    </div>
</template>
<script>
import InputText from 'primevue/inputtext'
import Header from "./Comun/Header.vue";
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Notify } from 'notiflix';

export default {
    components: {
        Header,
        InputText,
    },
    props: {
        ciudades: {
            type: Array,
            required: true,
        },
    },
    setup() {
        const data = reactive({
            usuario: '',
            password: '',
            password_confirmation: '',
            nombre: '',
            apellido_p: '',
            apellido_m: '',
            email: '',
            ci: '',
            telefono: '',
            ciudad: '',

        });
        const registro = () => {
            console.log("submit")

            Inertia.post(route("registro"), data,
                {
                    onSuccess: (success) => {
                        Notify.success(success.props.flash.success);
                        /* Ahora el post del login */
                        Inertia.post(
                            route("loginPost"),
                            {
                                usuario: data.usuario,
                                password: data.password,
                            },
                            {
                                preserveScroll: true,
                            }
                        );
                    },
                    onError: (error) => {
                        for (let i in error) {
                            Notify.failure(error[i]);
                        }
                    },
                })
        };
        return {
            registro,
            data,
        }
    }

}
</script>


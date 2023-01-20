<template>
    <div>
        <v-dialog max-width="600" persistent  v-model="dialog">
            <template v-slot:activator="{ on, attrs }">
                <v-btn small fab color="primary" v-bind="attrs" v-on="on">
                    <v-icon>mdi-clipboard-account </v-icon>
                </v-btn>
            </template>
            <template v-slot:default="dialog">
                <v-card>
                    <v-toolbar color="primary" dark>
                        Registrar Asistencia
                    </v-toolbar>

                    <v-alert
                        v-if="show_mensaje"
                        class="rounded-0 my-2"
                        dense
                        text
                        dismissible
                        :type="type_mensaje"
                    >
                        <small> {{ mensaje }} </small>
                    </v-alert>

                    <v-card-text>
                        <div class="ma-auto pt-4" style="max-width: 350px">
                            <div class="text-h6">DNI:</div>
                            <v-otp-input
                                v-model="dni_trabajador"
                                :disabled="loading"
                                length="8"
                                type="number"
                                @finish="getAsistencia"
                            ></v-otp-input>
                            <v-overlay absolute :value="loading">
                                <v-progress-circular
                                    indeterminate
                                    color="primary"
                                ></v-progress-circular>
                            </v-overlay>
                        </div>

                        <v-divider></v-divider>

                        <template v-if="asistencia">
                            <div class="pa-4">
                                <div class="text-h6 mb-2">
                                    <strong>Trabajador: </strong>
                                    {{ asistencia.tra_nombre }}
                                    {{ asistencia.tra_apellidos }}
                                </div>

                                <div class="text-h6 mb-2">
                                    <strong>Hora de entrada: </strong>
                                    <template v-if="asistencia.asi_entrada">
                                        {{ asistencia.asi_entrada }}
                                    </template>
                                    <template v-else>
                                        {{ form.hora }}
                                        <v-btn
                                            dark
                                            small
                                            color="blue"
                                            @click="RegistarIngreso"
                                        >
                                            <v-icon small left
                                                >mdi-login</v-icon
                                            >
                                            Registar ingreso
                                        </v-btn>
                                    </template>
                                </div>

                                <div class="text-h6 mb-2">
                                    <strong>Hora de salida: </strong>

                                    <template
                                        v-if="
                                            asistencia.asi_entrada &&
                                            asistencia.asi_salida
                                        "
                                    >
                                        {{ asistencia.asi_salida }}
                                    </template>
                                    <template
                                        v-if="
                                            asistencia.asi_entrada &&
                                            asistencia.asi_salida == null
                                        "
                                    >
                                        {{ form.hora }}
                                        <v-btn
                                            color="red"
                                            small
                                            @click="RegistarSalida"
                                        >
                                            <v-icon left small
                                                >mdi-logout</v-icon
                                            >
                                            Registar salida
                                        </v-btn>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </v-card-text>
                    <v-card-actions class="justify-end">
                        <v-btn
                            color="red"
                            text
                            small
                            @click="CerrarModal"
                            >Cerrar</v-btn
                        >
                    </v-card-actions>
                </v-card>
            </template>
        </v-dialog>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data: () => ({
        dialog: false,
        loading: false,
        dni_trabajador: "",
        asistencia: false,
        hora_entrada: false,
        form: {
            id: "",
            hora: "",
        },

        defatul_form: {
            id: "",
            hora: "",
        },

        show_mensaje: false,
        type_mensaje: "success",
        mensaje: "",
    }),

    methods: {
        async getAsistencia(rsp) {
            this.loading = true;
            try {
                let res = await axios.get("/asistencia/get/" + rsp);
                this.asistencia = res.data.datos;
                this.form.id = res.data.datos.asi_id;
                this.form.hora = new Date().toLocaleTimeString();
            } catch (error) {
                this.type_mensaje = "error";
                this.mensaje = error.response.data.error;
                this.show_mensaje = true;
            } finally {
                this.loading = false;
            }
        },

        async RegistarIngreso() {
            try {
                let res = await axios.post("/asistencia/ingreso/", this.form);

                this.type_mensaje = "success";
                this.show_mensaje = true;
                this.mensaje = res.data.mensaje;

                this.form = this.defatul_form;
                this.asistencia = false;
                this.dni_trabajador = "";
            } catch (error) {
                this.type_mensaje = "error";
                this.mensaje = error.response.data.error;
                this.show_mensaje = true;
            }
        },

        async RegistarSalida() {
            try {
                let res = await axios.post("/asistencia/salida/", this.form);

                this.type_mensaje = "success";
                this.show_mensaje = true;
                this.mensaje = res.data.mensaje;

                this.form = this.defatul_form;
                this.asistencia = false;
                this.dni_trabajador = "";
            } catch (error) {
                this.type_mensaje = "error";
                this.mensaje = error.response.data.error;
                this.show_mensaje = true;
            }
        },

        CerrarModal() {
            this.form = this.defatul_form;
            this.asistencia = false;
            this.dni_trabajador = "";

            this.dialog = false;
        },
    },
};
</script>

<style scoped>
.position-relative {
    position: relative;
}
</style>

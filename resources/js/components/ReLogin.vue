<template>
    <div class="text-center">
        <v-dialog v-model="dialog" persistent width="350">
            <v-card>
                <v-card-title class="text-h6 white--text primary lighten-1">
                    Su sesión ha caducado
                </v-card-title>

                <v-container>
                    <h3 class="text-center">
                        {{ user.nombres }} {{ user.apellidos }}
                    </h3>

                    <v-divider> </v-divider>

                    <v-form ref="form" v-model="form_valid" lazy-validation>
                        <v-row>
                            <v-col cols="12" class="pb-1 pt-5">
                                <v-text-field
                                    class="my-3"
                                    dense
                                    outlined
                                    hide-details
                                    v-model="password"
                                    :append-icon="
                                        show_password
                                            ? 'mdi-eye'
                                            : 'mdi-eye-off'
                                    "
                                    :rules="[rules.required]"
                                    :type="show_password ? 'text' : 'password'"
                                    name="input-10-1"
                                    label="Contraseña"
                                    @click:append="
                                        show_password = !show_password
                                    "
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-btn
                                    block
                                    :disabled="!form_valid"
                                    color="primary"
                                    class="mb-2"
                                    @click="Ingresar"
                                >
                                    Ingresar
                                </v-btn>

                                <v-btn small block color="dark" text @click="()=>{this.$emit('dialog', false)} ">
                                    No soy yo
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-container>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    props: {
        user: Object,
        dialog: Boolean,
    },
    data: () => ({
   
        show_password: false,
        form_valid: true,
        password: "",
        rules: {
            required: (value) => !!value || "Required.",
        },
    }),

    methods: {
        async Ingresar() {
            if (this.$refs.form.validate()) {
                console.log(this.user.email + " - " + this.password);
            }
        },
    },
};
</script>

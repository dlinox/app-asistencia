<template>
    <v-app>
        <v-main class="main-login">
            <div class="container-logo">
                <img
                    width="200"
                    class="mx-auto"
                    src="/images/logomin.png"
                    alt=""
                />
            </div>
            <v-card class="mx-auto elevation-10" max-width="400">
                <v-img
                    gradient="to bottom, rgba(0,0,0,.2), rgba(0,0,0,6)"
                    class="white--text align-end"
                    height="150px"
                    src="/images/unap.jpg"
                >
                    <v-card-title>Sistema de inventario</v-card-title>
                    <v-card-subtitle class="">
                        <strong> INGRESAR AL SISTEMA</strong>
                    </v-card-subtitle>
                </v-img>

                <v-card-subtitle class="pb-0">
                    Ingrese sus datos de acceso
                </v-card-subtitle>

                <v-alert
                    v-if="show_mensaje"
                    class="rounded-0 my-1"
                    dense
                    text
                    :type="type_mensaje"
                >
                    <small> {{ mensaje }} </small>
                </v-alert>

                <v-form
                    class="px-5 pb-5 mt-3"
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                    <v-text-field
                        dense
                        v-model="email"
                        :rules="[rules.required, rules.email]"
                        label="Correo Electronico"
                        required
                        outlined
                    ></v-text-field>

                    <v-text-field
                        dense
                        outlined
                        v-model="password"
                        :append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'"
                        :rules="[rules.required, rules.min]"
                        :type="show_password ? 'text' : 'password'"
                        name="input-10-1"
                        label="Contraseña"
                        hint="At least 8 characters"
                        counter
                        @click:append="show_password = !show_password"
                    ></v-text-field>

                    <v-btn
                        :disabled="!valid"
                        color="primary"
                        class="mt-4"
                        block
                        :loading="loading_btn"
                        @click="IngresarSistema"
                    >
                        INGRESAR
                    </v-btn>
                </v-form>
            </v-card>
        </v-main>
    </v-app>
</template>

<script>
export default {
    metaInfo: { title: "Login" },
    data: () => ({
        loading_btn: false,
        show_password: false,
        email: "dpumaticona@gmail.com",
        password: "demo",
        valid: true,

        show_mensaje: false,
        type_mensaje: "success",
        mensaje: "",
        rules: {
            required: (value) => !!value || "Requerido.",
            min: (v) => v.length >= 4 || "Min 6 caracteres",
            email: (v) => /.+@.+\..+/.test(v) || "Formato incorrecto",
        },
    }),

    methods: {
        validate() {
            return this.$refs.form.validate();
        },
        async IngresarSistema() {
            if (this.validate()) {
                try {
                    this.loading_btn = true;
                    let res = await axios.post("/login", {
                        email: this.email,
                        password: this.password,
                    });
                    this.show_mensaje = true;
                    this.mensaje = res.data.mensaje;
                    this.loading_btn = false;

                    console.log(res);
                    this.$inertia.get("/");
                } catch (error) {
                    this.type_mensaje = "error";
                    this.mensaje = error.response.data.error;
                    this.show_mensaje = true;
                    this.loading_btn = false;
                    console.log(error);
                }
            }
        },
    },
};
</script>
<style>
@import url("https://fonts.googleapis.com/css2?family=Sora:wght@100;200;300;400;500;600;700;800&display=swap");
* {
    font-family: "Sora", sans-serif;
}
.main-login {
    background-color: whitesmoke;
    align-items: center;
}
.container-logo {
    display: flex;
    width: 100%;
    justify-content: center;
}
</style>

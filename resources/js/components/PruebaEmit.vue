<template>
    <div>
        <h3>
            quero pasar este dato

            <br />
            {{ mensaje }}
        </h3>

        <v-btn @click="EnviarMensaje()"> Enviar mensaje </v-btn>
    </div>
</template>

<script>
export default {
    data: () => ({
        mensaje: "Mensaje para emiir",
        cont: 1,
    }),
    methods: {
        EnviarMensaje() {
            console.log("se hizo clik");
            this.$emit("miMensaje", this.cont);
        },
    },
};
</script>

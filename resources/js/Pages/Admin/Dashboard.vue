<template>
    <v-container>
        <h1>dashboard</h1>
        <PruebaEmit @miMensaje="mensaje_hijo += $event" />
        ---> {{mensaje_hijo}}
    </v-container>
</template>

<script>
import Layout from "@/Layouts/AdminLayout";

import PruebaEmit from "../../components/PruebaEmit.vue";
export default {
    metaInfo: { title: "Dashboard" },
    components: {  PruebaEmit },
    layout: Layout,
    data: () => ({
        mensaje_hijo: 0,
    }),
};
</script>

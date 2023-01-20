<template>
    <v-app>
        <v-main>

            <h2>{{ mensaje }}</h2>

            <v-alert
      border="top"
      color="red lighten-2"
      dark
    >
      I'm an alert with a top border and red color
    </v-alert>
        </v-main>
    </v-app>
</template>

<script>
export default {
    metaInfo: { title: "Login" },
    data: () => ({

        mensaje: "Funcionando",

    }),

   
};
</script>

<style>
</style>
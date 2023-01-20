<template>
    <v-app class="app-wrapper">
        <v-system-bar dark color="primary">
            <v-spacer></v-spacer>
            <v-icon>mdi-wifi-strength-4</v-icon>
            <v-icon>mdi-signal-cellular-outline</v-icon>
            <v-icon>mdi-battery</v-icon>
            <span>12:30</span>
        </v-system-bar>

        <v-app-bar color="white">
            <v-spacer />

            <v-menu offset-y>
                <template v-slot:activator="{ attrs, on }">
                    <v-btn
                        text
                        color="primary"
                        class=""
                        v-bind="attrs"
                        v-on="on"
                    >
                        Pepe Inve
                        <v-icon right>mdi-account </v-icon>
                    </v-btn>
                </template>

                <v-list dense>
                    <v-subheader>Opciones</v-subheader>
                    <v-list-item-group v-model="selectedItem" color="primary">
                        <v-list-item v-for="(item, i) in items" :key="i">
                            <v-list-item-icon>
                                <v-icon v-text="item.icon"></v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title
                                    v-text="item.text"
                                ></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                </v-list>
            </v-menu>
        </v-app-bar>
        <v-main class="main-wrapper">
            <v-container class="my-3">
                <v-card class="mx-auto" max-width="850">
                    <v-row class="pa-4" align="center">
                        <v-col cols="12" sm="7" md="8" class="py-1 py-md-2">
                            <div class="text-h6">Registar</div>
                        </v-col>
                        <v-col cols="12" sm="auto" class="ml-auto py-1 py-md-2">
                            <AreasAsignadasComponent />
                        </v-col>

                        <v-col cols="12">
                            <div
                                class="d-flex flex-wrap align-items-center justify-space-between"
                            >
                                <v-btn
                                    class="mr-sm-2 order-sm-1 mb-2 mb-sm-0"
                                    dark
                                    color="primary"
                                >
                                    <v-icon>mdi-plus</v-icon>
                                </v-btn>
                                <v-text-field
                                    class="pt-0 order-sm-2 order-last"
                                    dense
                                    label="Codigo"
                                    outlined
                                ></v-text-field>

                                <BusquedaAvanzadaComponent />

                                <v-btn
                                    class="mr-sm-2 order-sm-4"
                                    outlined
                                    dark
                                    color="primary"
                                >
                                    <v-icon>mdi-barcode-scan</v-icon>
                                </v-btn>
                            </div>
                        </v-col>

                        <v-col cols="12" sm="4" md="4" class="pb-1 pt-0">
                            <v-text-field
                                class="mt-0 pt-0"
                                dense
                                hint-
                                label="Codigo"
                                value="asd"
                                disabled
                                outlined
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="8" md="8" class="pb-1 pt-0">
                            <v-text-field
                                class="mt-0 pt-0"
                                dense
                                label="Nombre"
                                outlined
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6" sm="6" md="6" class="pb-1 pt-0">
                            <v-text-field
                                class="mt-0 pt-0"
                                dense
                                label="Marca"
                                outlined
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6" sm="6" md="6" class="pb-1 pt-0">
                            <v-text-field
                                class="mt-0 pt-0"
                                dense
                                label="Modelo"
                                outlined
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6" sm="4" md="4" class="pb-1 pt-0">
                            <v-text-field
                                class="mt-0 pt-0"
                                dense
                                label="Serie"
                                outlined
                            ></v-text-field>
                        </v-col>
                        <v-col cols="6" sm="4" md="4" class="pb-1 pt-0">
                            <v-text-field
                                class="mt-0 pt-0"
                                dense
                                label="Numero"
                                outlined
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="4" md="4" class="pb-1 pt-0">
                            <v-autocomplete
                                clearable
                                class="mt-0 pt-0"
                                dense
                                label="Estado"
                                outlined
                                :items="states"
                                item-text="name"
                            ></v-autocomplete>
                        </v-col>
                        <v-col cols="12" class="pb-1 pt-0 d-flex">
                            <v-text-field
                                class="mt-0 pt-0"
                                dense
                                label="Responsable"
                                outlined
                            ></v-text-field>

                            <template v-if="respo_2">
                                <v-text-field
                                    class="mt-0 pt-0 ml-2"
                                    dense
                                    label="Responsable"
                                    outlined
                                ></v-text-field>

                                <v-btn
                                    class="ml-2"
                                    dark
                                    color="red"
                                    @click="respo_2 = !respo_2"
                                >
                                    <v-icon>mdi-account-minus</v-icon>
                                </v-btn>
                            </template>
                            <template v-else>
                                <v-btn
                                    class="ml-2"
                                    dark
                                    color="primary"
                                    @click="respo_2 = !respo_2"
                                >
                                    <v-icon>mdi-account-plus</v-icon>
                                </v-btn>
                            </template>
                        </v-col>
                        <v-col cols="12" sm="6" class="pb-1 pt-0">
                            <v-text-field
                                class="mt-0 pt-0"
                                dense
                                label="Oficina"
                                outlined
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" class="pb-1 pt-0">
                            <v-text-field
                                class="mt-0 pt-0"
                                dense
                                label="Area"
                                outlined
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12" s class="pb-1 pt-0">
                            <v-textarea
                                class="mt-0 pt-0"
                                label="Responsable"
                                dense
                                outlined
                                rows="2"
                            ></v-textarea>
                        </v-col>
                        <v-col cols="12" s class="pb-1 pt-0">
                            <v-btn block class="mr-2" dark color="primary">
                                <v-icon left>mdi-content-save-check</v-icon>
                                Guardar
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import AreasAsignadasComponent from "./Inventario/Components/AreasAsignadasComponent.vue";
import BusquedaAvanzadaComponent from "./Inventario/Components/BusquedaAvanzadaComponent.vue";
export default {
    components: { AreasAsignadasComponent, BusquedaAvanzadaComponent },
    data: () => ({
        respo_2: false,
        btns: [
            ["Removed", "0"],
            ["Large", "lg"],
            ["Custom", "b-xl"],
        ],
        colors: ["deep-purple accent-4", "error", "teal darken-1"],
        items: [
            { text: "Perfil", icon: "mdi-account" },
            { text: "Configuracion", icon: "mdi-cog" },
            { text: "Salir", icon: "mdi-power" },
        ],
        selectedItem: 1,
        states: [
            {
                name: "Florida",
                abbr: "FL",
                id: 1,
            },
            {
                name: "Georgia",
                abbr: "GA",
                id: 2,
            },
            {
                name: "Nebraska",
                abbr: "NE",
                id: 3,
            },
            {
                name: "California",
                abbr: "CA",
                id: 4,
            },
            {
                name: "New York",
                abbr: "NY",
                id: 5,
            },
        ],
    }),
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

* {
    font-family: "Montserrat", sans-serif;
}
.main-wrapper {
    background-color: #eaeaea;
}

.v-btn:not(.v-btn--round).v-size--default {
    height: 40px;
    min-width: 64px;
    padding: 0 16px;
}

.v-messages {
    flex: 1 1 auto;
    font-size: 10px;
    height: 12px;
    min-width: 1px;
    position: relative;
}

.v-text-field__details {
    display: flex;
    flex: 1 0 auto;
    max-width: 100%;
    max-height: 12px;
    overflow: hidden;
}

.v-text-field.v-text-field--enclosed .v-text-field__details {
    padding-top: 0;
    margin-bottom: 0px;
}

.v-text-field--outlined fieldset {
    border: 1px solid #d4d4d8;
}

.v-text-field .v-input__control,
.v-text-field .v-input__slot,
.v-text-field fieldset {
    border-radius: 0.375rem;
}
</style>

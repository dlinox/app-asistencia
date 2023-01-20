<template>
    <div class="wrapper-page">
        <div class="page-heading">
            <div class="page-details">
                <v-toolbar outlined color="grey lighten-3" elevation="0">
                    <v-toolbar-title>
                        <v-app-bar-nav-icon @click="drawer = !drawer">
                            <v-icon>mdi-filter-menu</v-icon>
                        </v-app-bar-nav-icon>

                        Usuarios
                    </v-toolbar-title>
                </v-toolbar>
            </div>
            <div class="page-search">
                <v-toolbar outlined color="grey lighten-5" elevation="0">
                    <v-text-field
                        v-model="usuario_search"
                        append-icon="mdi-magnify"
                        label="Buscar"
                        hide-details
                        outlined
                        dense
                    ></v-text-field>
                </v-toolbar>
            </div>
        </div>
        <div class="content-wrapper">
            <v-navigation-drawer
                absolute
                v-model="drawer"
                color="grey lighten-5"
            >
                <v-container>
                    <v-btn block color="primary">
                        <v-icon left>mdi-plus</v-icon>
                        Nuevo
                    </v-btn>

                    <div class="mt-5">
                        <h5 class="pb-3 grey--text text--darken-2">
                            Filtar por Rol
                        </h5>

                        <v-autocomplete
                            v-model="rol"
                            :items="roles"
                            item-text="name"
                            item-value="id"
                            label="Seleccione un Area"
                            outlined
                            dense
                        ></v-autocomplete>

                        <h5 class="pb-3 grey--text text--darken-2">
                            Filtar por Oficina / Area
                        </h5>

                        <SelectOficina v-model="oficina" />

                        <v-autocomplete
                            v-model="area"
                            :items="areas"
                            item-text="nombre"
                            item-value="id"
                            label="Seleccione un Area"
                            outlined
                            dense
                        ></v-autocomplete>

                        <v-btn
                            class="mb-3"
                            block
                            outlined
                            color="primary"
                            @click="aplicarFiltros"
                        >
                            <v-icon left>mdi-filter</v-icon>
                            Aplicar Filtros
                        </v-btn>

                        <v-btn
                            class="mb-3"
                            block
                            color="red"
                            @click="eliminarFiltros"
                            text
                        >
                            <v-icon left>mdi-filter-remove</v-icon>
                            Quitar Filtros
                        </v-btn>
                    </div>
                </v-container>
            </v-navigation-drawer>
            <div class="content" :class="drawer ? '' : 'full'">
                <v-container>
                    <v-card :loading="loading_table">
                        <v-simple-table>
                            <template v-slot:default>
                                <thead class="grey lighten-1">
                                    <tr>
                                        <th class="text-left">Nombres</th>
                                        <th class="text-left">Apellidos</th>
                                        <th class="text-left">Correo</th>
                                        <th class="text-left">Areas</th>
                                        <th class="text-left">Rol</th>
                                        <th class="text-left"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(item, index) in list_usuarios"
                                        :key="index"
                                    >
                                        <td>{{ item.nombres }}</td>
                                        <td>{{ item.apellidos }}</td>
                                        <td>
                                            {{ item.email }}
                                        </td>

                                        <td>
                                            <v-badge
                                                :content="item.areas.length"
                                                :value="item.areas.length"
                                                color="green"
                                                overlap
                                            >
                                                Areas
                                            </v-badge>
                                           
                                        </td>

                                        <td>
                                            {{ item.rol_name }}
                                        </td>

                                        <td>
                                            <v-menu offset-y>
                                                <template
                                                    v-slot:activator="{
                                                        attrs,
                                                        on,
                                                    }"
                                                >
                                                    <v-btn
                                                        icon
                                                        text
                                                        color="primary"
                                                        class=""
                                                        v-bind="attrs"
                                                        v-on="on"
                                                    >
                                                        <v-icon>
                                                            mdi-dots-vertical
                                                        </v-icon>
                                                    </v-btn>
                                                </template>

                                                <v-list dense>
                                                    <v-subheader
                                                        >Opciones</v-subheader
                                                    >
                                                    <v-list-item-group
                                                        color="primary"
                                                    >
                                                        <v-list-item
                                                            v-for="(
                                                                val, i
                                                            ) in itemsOptions"
                                                            :key="i"
                                                            @click="
                                                                SelectMenu(
                                                                    val.text,
                                                                    item
                                                                )
                                                            "
                                                        >
                                                            <v-list-item-icon>
                                                                <v-icon
                                                                    v-text="
                                                                        val.icon
                                                                    "
                                                                ></v-icon>
                                                            </v-list-item-icon>
                                                            <v-list-item-content>
                                                                <v-list-item-title
                                                                    v-text="
                                                                        val.text
                                                                    "
                                                                ></v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                    </v-list-item-group>
                                                </v-list>
                                            </v-menu>
                                        </td>
                                    </tr>
                                </tbody>
                            </template>
                        </v-simple-table>

                        <v-pagination
                            v-model="page"
                            class=""
                            :length="pages"
                        ></v-pagination>
                    </v-card>
                </v-container>
            </div>
        </div>

        <v-dialog
            transition="dialog-top-transition"
            max-width="500"
            persistent
            v-model="dialog_asignar"
        >
            <v-card>
                <v-card-title primary-title>
                    Asignar Area - {{ user_asignar.nombres }}
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text class="mt-3">
                    <SelectOficina v-model="oficina_asig"></SelectOficina>

                    <v-autocomplete
                        v-model="area_asig"
                        :items="areas_asig"
                        item-text="nombre"
                        item-value="id"
                        label="Seleccione un Area"
                        outlined
                        dense
                        multiple
                    ></v-autocomplete>

                    <v-btn
                        class="mr-3"
                        text
                        color="red"
                        @click="dialog_asignar = false"
                    >
                        cancelar
                    </v-btn>
                    <v-btn
                        :disabled="!area_asig.length > 0"
                        color="success"
                        @click="guardarAsingar"
                    >
                        Asignar
                    </v-btn>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</template>
<script>
import Layout from "@/Layouts/AdminLayout";
import SelectOficina from "@/components/autocomplete/SelectOficina.vue";
import axios from "axios";

export default {
    metaInfo: { title: "Usuarios" },
    layout: Layout,
    props: {
        roles: Array,
    },

    data: () => ({
        dialog_asignar: false,
        user_asignar: {},
        itemsOptions: [
            { text: "Asignar Area", icon: "mdi-map-marker-account-outline" },
            { text: "Editar", icon: "mdi-pen" },
            { text: "Eliminar", icon: "mdi-delete" },
        ],
        loading_table: false,
        oficina: null,
        areas: [],
        area: null,
        rol: null,

        oficina_asig: null,
        area_asig: [],
        areas_asig: null,

        absolute: false,
        drawer: true,

        page: 1,
        total_result: 0,
        pages: 1,
        usuario_search: "",
        list_usuarios: [],
    }),
    computed: {
        size_display: {
            get: function () {
                if (this.$vuetify.breakpoint.width > 960) {
                    this.absolute = false;
                    return true;
                }
                this.absolute = true;
                return false;
            },
            set: function (newValue) {},
        },
    },
    methods: {
        async getUsuarios(
            term = "",
            rol = "",
            oficina = "",
            area = "",
            page = 1
        ) {

            this.loading_table = true;
            let res = await axios.post(
                "/admin/usuarios/get-usuarios?page=" + page,
                {
                    term: term,
                    rol: rol,
                    oficina: oficina,
                    area: area,
                }
            );
            console.log(res.data.datos.data);
            this.page = res.data.datos.current_page;
            this.total_result = res.data.datos.total;
            this.pages = res.data.datos.last_page;

            this.loading_table = false;

            return res.data.datos.data;
        },

        async aplicarFiltros() {
            let res = await this.getUsuarios(
                this.usuario_search,
                this.rol,
                this.oficina,
                this.area
            );
            this.list_usuarios = res;
        },
        async eliminarFiltros() {
            this.usuario_search = null;
            this.rol = null;
            this.oficina = null;
            this.area = null;
            let res = await this.getUsuarios();
            this.list_usuarios = res;
        },
        SelectMenu(op, user) {
            if (op == "Asignar Area") {
                this.asignarArea(user);
            }
        },
        async asignarArea(user) {
            console.log(user);
            this.user_asignar = user;
            this.dialog_asignar = true;
        },
        async guardarAsingar() {
            let res = await axios.post("/admin/usuarios/asignar-area", {
                areas: this.area_asig,
                usuario: this.user_asignar.id,
            });
            
            this.list_usuarios = await this.getUsuarios();
            this.user_asignar = {};
            this.dialog_asignar = false;
        },
    },
    async created() {
        this.drawer = this.$vuetify.breakpoint.width > 960 ? true : false;
        this.absolute = this.$vuetify.breakpoint.width > 960 ? false : true;
        this.list_usuarios = await this.getUsuarios();
    },

    watch: {
        async usuario_search(val) {
            if (!val) return;
   
            let res = await this.getUsuarios(
                val,
                this.rol,
                this.oficina,
                this.area
            );
            this.list_usuarios = res;
        },
        async page(val, old_val) {
            if (!val) return;
            if (val == old_val) return;
            //this.loading_table = true;
            let res = await this.getUsuarios(
                this.usuario_search,
                this.rol,
                this.oficina,
                this.area,
                val
            );
            this.list_usuarios = res;
            //this.loading_table = false;
        },

        async oficina(val) {
            if (!val) return;
            let res = await axios.get("/inventario/search-areas/" + val);
            this.areas = res.data.datos;
        },
        async oficina_asig(val) {
            if (!val) return;
            let res = await axios.get("/inventario/search-areas/" + val);
            this.areas_asig = res.data.datos;
        },

        async rol(val) {
            if (!val) return;
            let res = await this.getUsuarios(this.usuario_search, val);
            this.list_usuarios = res;
        },
    },
    components: { SelectOficina },
};
</script>

<style>
.wrapper-page {
    width: 100%;
    height: 100%;
    background-color: #fafafa;
}

.page-heading {
    display: flex;
    justify-content: space-between;
}
.page-details {
    width: 256px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    border-right: 1px solid rgba(0, 0, 0, 0.1);
}
.page-search {
    width: calc(100% - 256px);
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.content-wrapper {
    position: relative;
    display: flex;
    width: 100%;
    height: 100%;
}

.content {
    width: 100%;
    margin-left: 256px;
    transition: all 0.3s ease;
}

.content.full {
    width: 100%;
    margin-left: 0;
}

@media (max-width: 960px) {
    .content {
        margin-left: 0;
    }

    .page-details {
        width: 200px;
    }
    .page-search {
        width: calc(100% - 200px);
    }
}

@media (max-width: 740px) {
    .page-details {
        width: 180px;
    }
    .page-search {
        width: calc(100% - 180px);
    }
}
</style>

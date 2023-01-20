<template>
    <v-app>
        <v-navigation-drawer app v-model="drawer" color="#01305A" dark>
            <div class="wrap-imagen py-4">
                <img width="80%" src="/images/logomin.png" alt="" />
            </div>

            <v-card flat rounded="0" color="transparent">
                <v-list two-line class="py-0">
                    <v-list-item>
                        <v-list-item-avatar color="secondary">
                            <span class="white--text headline">
                                <small> AA </small>
                            </span>
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title>
                                {{ user.nombres }}
                            </v-list-item-title>
                            <v-list-item-subtitle>
                                {{ user.rol }}
                            </v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-card>

            <v-divider />

            <menu-principal-component />

            <template v-slot:append>
                <v-divider></v-divider>
                <v-card-text class="text-center py-1">
                    <v-btn class="mx-4" icon link @click="salir">
                        <v-icon size="24px" color="blue-grey lighten-4">
                            mdi-power
                        </v-icon>
                    </v-btn>
                </v-card-text>
            </template>
        </v-navigation-drawer>
        <v-app-bar app color="white" scroll-off-screen elevation="3">
            <v-app-bar-nav-icon
                @click.stop="drawer = !drawer"
            ></v-app-bar-nav-icon>

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
                        {{ user.nombres }}
                        <v-icon right>mdi-account </v-icon>
                    </v-btn>
                </template>

                <v-list dense>
                    <v-subheader>Opciones</v-subheader>
                    <v-list-item-group v-model="selectedMenu" color="primary">
                        <v-list-item
                            v-for="(item, i) in items"
                            :key="i"
                            @click="SelectMenu(item.text)"
                        >
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

        <v-main class="main_app">
            <transition name="component-fade" mode="out-in">
                <slot />
            </transition>
        </v-main>
        
    </v-app>
</template>
<script>
import MenuPrincipalComponent from "@/components/MenuPrincipalComponent";
export default {
    components: {
        MenuPrincipalComponent,
    },
    data: () => ({
        drawer: true,
        attrs: {
            class: "mb-1",
            boilerplate: true,
            elevation: 0,
            loading: false,
        },

        closeOnContentClick: true,

        items: [
            { text: "Perfil", icon: "mdi-account" },
            { text: "Configuracion", icon: "mdi-cog" },
            { text: "Salir", icon: "mdi-power" },
        ],
        selectedMenu: null,
    }),
    computed: {
        user() {
            return this.$page.props.auth.user;
        },
    },
    methods: {
        salir() {
            this.$inertia.post("/logout");
        },
    },
    async created() {
        //await this.GetCurrentUser();

        this.drawer = this.$vuetify.breakpoint.width > 960 ? true : false;
    },
};
</script>
<style scoped>
/*@import url("https://fonts.googleapis.com/css2?family=Sora:wght@100;200;300;400;500;600;700;800&display=swap");*/
@import url('https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&display=swap');
* {
    font-family: 'Nunito', sans-serif;
}
.main_app {
    background: #eeeeee;
}
.component-fade-enter-active,
.component-fade-leave-active {
    transition: opacity 0.3s ease;
}
.component-fade-enter, .component-fade-leave-to
/* .component-fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
.wrap-imagen {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    background-color: rgba(255, 255, 255, 0.3);
}


</style>

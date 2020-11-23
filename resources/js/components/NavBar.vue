<template>
    <div>
        <figure
            ref="showNavBtn"
            class="show-div-btn"
            @click="showNav()">
            <i class="fas fa-bars fa-2x"></i>
        </figure>

        <nav
            ref="nav"
            :style="{ background: background || '#000'}"
        >
            <figure
                @click="hideNav">

                <i class="fas fa-times fa-2x"></i>
            </figure>
            <ul>
                <li
                    v-for="(link, index) in navLinks"
                    :key="index"
                    :style="{ color: linkColor || '#fff' }"
                >
                    <router-link
                        :to="link.path"
                        v-on:click.native="register(link.name)"
                    >
                        {{ filterVisibleNavLinks(link) }}
                    </router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: {
            navLinks: Array,
            background: String,
            linkColor: String,
            linkHoverBackground: String
        },
        methods: {
            filterVisibleNavLinks(link) {
                //link.name == 'REGISTER' && isLoggedIn ? '' : link.name
                if ((link.name == 'REGISTER' && this.isLoggedIn) || link.name == 'VERIFY')
                {
                    return ''
                }
                else {
                    return link.name;
                }
            }
            ,
            showNav(event) {
                this.$refs.showNavBtn.classList.add('disappear-top');
                this.$refs.nav.classList.add('active');
                this.$emit('showOverlay', true);
            },
            hideNav() {
                this.$refs.nav.classList.remove('active');
                this.$refs.showNavBtn.classList.remove('disappear-top');
                this.$emit('showOverlay', false);
            },
            register(pathName) {
                if (pathName == 'REGISTER') {
                    if (!this.$store.state.registerModalVisible)
                    {
                        this.$store.commit('toggleRegisterModalVisibleState');
                    }
                    this.hideNav();

                    if (this.$store.state.loginModalVisible)
                    {
                        this.$store.commit('toggleLoginModalVisibleState');
                    }
                }
            },
        },
        computed: {
            isLoggedIn() {
                return this.$store.state.isLoggedIn;
            }
        }
    }
</script>

<style scoped lang="scss">
    .show-div-btn {
        position: fixed;
        top: 10px;
        left: 10px;
        transition: top 0.9s ease-in-out;
        &.disappear-top {
            top: -30px;
        }
    }
    nav {
        position: fixed;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100vh;
        min-width: 350px;
        max-width: 350px;
        padding: 50px 35px;
        opacity: 0.4;
        left: -350px;
        transition: left 0.9s ease-in-out;
        z-index: 9999;
        &.active {
            left: 0;
        }
        figure {
            position: absolute;
            left: 15px;
            top: 10px;
            i {
                color: white;
            }
        }
        ul {
            li {
                list-style: none;
                font-size: 25px;
                line-height: 1.9;
                a {
                    position: relative;
                    color: white;
                    &:hover {
                        color: white;
                        text-decoration: none;
                    }
                }
                a:before {
                    content: "";
                    position: absolute;
                    width: 100%;
                    height: 2px;
                    bottom: 0;
                    left: 0;
                    background: white;
                    visibility: hidden;
                    transform: scaleX(0);
                    transition: all 0.3s ease-in-out 0s;
                }
                a:hover:before {
                    visibility: visible;
                    transform: scaleX(1);
                }
            }
        }
    }
</style>

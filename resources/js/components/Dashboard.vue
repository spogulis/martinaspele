<template>
    <div ref="dashboard" class="dashboard">
        <div class="dashboard-left">
            <div class="dashboard-left-top">
                <img :src="imageLoaded" alt="User image">
                <h1>Level: {{ getUserGeneralLevel }}</h1>
            </div>
            <div class="dashboard-left-bottom">

            </div>
        </div>

        <div class="dashboard-right">
            <div class="dashboard-right-top">

            </div>
            <div class="dashboard-right-bottom">

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                imageLoading: false
            }
        },
        computed: {
            getUserGeneralLevel() {
                return this.$store.state.userGeneralLevel
            },
            imageLoaded() {
                return this.$store.state.userImage !== '' ? this.$store.state.userImage : '/images/user_image_placeholder.png'
            }
        },
        beforeMount() {
            this.$store.dispatch('getUserGeneralLevel');
            this.$store.dispatch('getUserImage');
        },
        mounted() {
            console.log(this.$store.state.userImage)
        }
    }
</script>

<style scoped lang="scss">
    @import '~/abstracts/_mixins.scss';

    h1 {
        color: white;
    }
    img {
        width: 100%;
    }
    .dashboard-left {
        width: 300px;
    }
    .dashboard-right {
        width: 100%;
    }
    .dashboard-left-top {
        height: 200px;
        padding: 20px 40px;
    }
    .dashboard-right-top {
        height: 100px;
    }
    .dashboard-right-bottom {
        min-height: 500px;
        border: 1px solid white;
        border-radius: 24px;
        background: white;
        opacity: 90%;
    }
    .dashboard {
        display: flex;
    }
    .dashboard-top {
        display: flex;
        min-height: 70px;
        width: 100%;
        border: 1px solid white;
    }
    .dashboard-bottom {
        // width: 100vh;;
    }
</style>

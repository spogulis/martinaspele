<template>
    <div ref="dashboard" class="dashboard">
        <div class="dashboard-left">
            <input
            type="file"
            ref="profileImageUploadInput"
            v-on:change="onProfileImageFileChange"
            style="display: none">
            <fab
                :actions="fabActions"
                @updatePicture="updatePicture"
                @alertMe="alert"
            />
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
    import fab from 'vue-fab'

    export default {
        components: {
            fab
        },
        data() {
            return {
                imageLoading: false,
                profileImage: null,
                fabActions: [
                    {
                        name: 'updatePicture',
                        icon: 'add_a_photo'
                    },
                    {
                        name: 'alertMe',
                        icon: 'add_alert'
                    }
                ]
            }
        },
        methods: {
            updatePicture() {
                this.$refs.profileImageUploadInput.click();
            },
            onProfileImageFileChange(e) {
                this.profileImage = e.target.files[0];

                if (this.profileImage) {
                    let formData = new FormData();
                    formData.append('image', this.profileImage);
                    this.$store.dispatch('setUserBGImage', formData);
                }
            },
            alert() {
                alert('Clicked on alert icon');
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

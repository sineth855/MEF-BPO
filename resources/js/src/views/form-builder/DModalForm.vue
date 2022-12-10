<template>
    <div class="demo-alignment">
        <vs-popup classContent="popup-example" title="បំពេញព័ត៌មានខាងក្រោម" :active.sync="showObjective">

            <div>
                <form>
                    <div class="vx-row lg:w-1/1 w-full">

                        <div class="vx-col w-full">
                            asf<vs-input v-validate="'required|alpha'" :placeholder="$t('label_name_kh')"
                                v-model="name_kh" class="w-full" />
                            <span class="text-danger text-sm" v-show="errors.has('name_kh')">{{ $t("required_name_kh")
                            }}</span>
                        </div>

                        <div class="vx-col w-full">
                            <vs-input v-validate="'required|alpha'" :placeholder="$t('label_name')" v-model="name"
                                class="mt-4 w-full" />
                            <span class="text-danger text-sm" v-show="errors.has('name')">{{ $t("required_name")
                            }}</span>
                        </div>

                        <div class="vx-col lg:w-1/2 w-full">
                            <vs-input v-validate="'required|alpha_dash'" :placeholder="$t('label_order_level')"
                                v-model="order_level" class="mt-4 w-full" />
                            <span class="text-danger text-sm" v-show="errors.has('order_level')">{{
                                    $t("required_order_level")
                            }}</span>
                        </div>

                        <div class="vx-col lg:w-1/2 w-full">
                            <vs-input v-validate="'required|alpha_dash'" placeholder="ពិព័ណ៌នា" v-model="remark"
                                class="mt-4 w-full" />
                        </div>

                    </div>
                    <span class="pull-right">
                        <vs-button type="filled" @click.prevent="submitObjective"
                            class="mt-5 block">{{ $t("btn_save") }}</vs-button>
                    </span>
                </form>
            </div>

            <!-- <vs-button @click="popupActive3=true" color="primary" type="filled">Open Inner Popup</vs-button> -->

            <!-- <vs-popup title="Inner popup" :active.sync="popupActive3">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </vs-popup> -->
        </vs-popup>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showObjective: false,
            name_kh: "",
            name: "",
            order_level: "",
            remark: ""
        }
    },
    methods: {
        initObjective(value) {
            this.showObjective = true;
        },
        submitObjective() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    // if form have no errors
                    alert("form submitted!");
                    this.$vs.notify({
                        title: 'Icon mail',
                        text: 'Lorem ipsum dolor sit amet, consectetur',
                        color: 'success',
                        iconPack: 'feather',
                        icon: 'icon-check',
                        position: 'top-right'
                    });
                    this.showObjective = false;
                } else {
                    // form have errors
                }
            })
        }
    }
}
</script>
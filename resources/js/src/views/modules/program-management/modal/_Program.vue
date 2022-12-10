<template>
    <div class="demo-alignment">
        <vs-popup classContent="popup-example" title="បង្កើតកម្មវិធី" :active.sync="showProgram">

            <div class="mt-5">
                <form>
                    <div class="vx-row lg:w-1/1 w-full">

                        <div class="vx-col w-full">
                            <vs-input v-validate="'required|alpha'" placeholder="ឈ្មោះគោលបំណង" name="name"
                                class="mt-5 w-full" />
                            <span class="text-danger text-sm" v-show="errors.has('name')">{{ errors.first('name')
                            }}</span>
                        </div>

                        <div class="vx-col lg:w-1/2 w-full">
                            <vs-input v-validate="'required|alpha_dash'" placeholder="តំរៀបតាមលំដាប់" name="order_level"
                                v-model="order_level" class="mt-5 w-full" />
                            <span class="text-danger text-sm" v-show="errors.has('order_level')">{{
                                    errors.first('order_level')
                            }}</span>
                        </div>

                        <div class="vx-col lg:w-1/2 w-full">
                            <vs-input v-validate="'required|alpha_dash'" placeholder="ពិព័ណ៌នា" name="description"
                                v-model="description" class="mt-5 w-full" />
                            <!-- <span class="text-danger text-sm" v-show="errors.has('description')">{{ errors.first('description') }}</span> -->
                        </div>

                        <!-- <div class="vx-col lg:w-1/2 w-full">
                                <vs-input v-validate="'required|email'" placeholder="Your Email" name="email" v-model="email" class="mt-5 w-full" />
                                <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                            </div>

                            <div class="vx-col lg:w-1/2 w-full">
                                <vs-input type="password" v-validate="'required|min:6|max:10'" ref="password" placeholder="Your Password" name="password" v-model="password" class="mt-5 w-full" />
                                <span class="text-danger text-sm" v-show="errors.has('password')">{{ errors.first('password') }}</span>
                            </div>

                            <div class="vx-col lg:w-1/2 w-full">
                                <vs-input type="password" v-validate="'required|min:6|max:10|confirmed:password'" data-vv-as="password" placeholder="Confirm Password" name="confirm_password" v-model="confirm_password" class="mt-5 w-full" />
                                <span class="text-danger text-sm" v-show="errors.has('confirm_password')">{{ errors.first('confirm_password') }}</span>
                            </div> -->

                    </div>
                    <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">Submit</vs-button>
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
            showProgram: false,
            name: "",
            order_level: "",
            description: ""
        }
    },
    methods: {
        initProgram(value) {
            this.showProgram = true;
        },
        submitForm() {
            this.$validator.validateAll().then(result => {
                if (result) {
                    // if form have no errors
                    alert("form submitted!");
                } else {
                    // form have errors
                }
            })
        }
    }
}
</script>
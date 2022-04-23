<template>
    <b-modal
        id="modal-product"
        ref="modal"
        :title="action === CREATE ? 'Create product' : 'Update product #'+product.id"
        @hidden="resetModal"
        @ok="handleOk"
    >
        <form ref="form" @submit.stop.prevent="handleSubmit">
            <b-form-group
                label="Name"
                label-for="name-input">
                <b-form-input
                    id="name-input"
                    v-model="product.name"
                    required
                ></b-form-input>
            </b-form-group>
            <b-form-group
                label="Description"
                label-for="description-input">
                <b-form-textarea
                    id="description-input"
                    v-model="product.description"
                    required
                ></b-form-textarea>
            </b-form-group>
            <b-form-group
                label="Value"
                label-for="value-input">
                <b-form-input
                    id="value-input"
                    v-model="product.value"
                    required
                ></b-form-input>
            </b-form-group>
            <b-form-group
                label="Slug"
                label-for="slug-input">
                <b-form-input
                    id="slug-input"
                    v-model="product.slug"
                    required
                ></b-form-input>
            </b-form-group>
            <b-form-group
                label=""
                label-for="active-input">
                <b-form-checkbox
                    id="active-input"
                    v-model="product.isActive">
                    Is active
                </b-form-checkbox>
            </b-form-group>
        </form>
    </b-modal>
</template>

<script>
export default {
    name: "CreateUpdateProductModal",
    props: ['action', 'product'],
    data() {
        return {
            CREATE: 'CREATE',
            UPDATE: 'UPDATE'
        }
    },
    methods: {
        handleOk() {
            let self = this;
            if(this.action === this.CREATE) {
                axios.post(window.routes.product_store, this.product)
                    .then((response)=>{
                        self.$emit('updateProduct')
                    });
            } else if(this.action === this.UPDATE) {
                axios.put('/admin/product/'+this.product.id, this.product)
                    .then((response)=>{
                        self.$emit('updateProduct')
                    })
            }
        },
        resetModal(){
            this.$emit('resetProductModal')
        }
    },
    created() {
        this.resetModal();
    }
}
</script>

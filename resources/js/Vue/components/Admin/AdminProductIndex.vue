<template>
    <div>
        <b-row>
            <b-col cols="2">
                <b-button variant="success" @click="createItem">Add new product</b-button>
            </b-col>
            <b-col cols="10">
                <b-pagination
                    align="right"
                    v-model="currentPage"
                    :total-rows="items.length"
                    :per-page="perPage"
                    aria-controls="my-table"
                ></b-pagination>
            </b-col>
        </b-row>
        <div class="overflow-auto">
            <b-table hover
                     :busy="isBusy"
                     id="my-table"
                     :items="items"
                     :fields="fields"
                     :per-page="perPage"
                     :current-page="currentPage"
                     small>
                <template #table-busy>
                    <div class="text-center text-danger my-2">
                        <b-spinner class="align-middle"></b-spinner>
                        <strong>Loading...</strong>
                    </div>
                </template>
                <template #cell(is_active)="row">
                    <b-badge v-if="row.item.is_active" variant="success">true</b-badge>
                    <b-badge v-else variant="danger">false</b-badge>
                </template>
                <template #cell(actions)="row">
                    <b-button variant="info" size="sm" :href="'admin/product/'+row.item.id" class="mr-1">
                        <b-icon icon="eye"></b-icon>
                    </b-button>
                    <b-button variant="warning" size="sm" @click="onEdit(row.item)" class="mr-1">
                        Edit
                    </b-button>
                    <b-button variant="danger" size="sm" @click="confirmDelete(row.item)">
                        Delete
                    </b-button>
                </template>
            </b-table>
        </div>
        <create-update-product-modal
            :action="actionModal"
            :product="product"
            @updateProduct="getItems"
            @resetProductModal="resetProductModal">
        </create-update-product-modal>
    </div>
</template>

<script>
export default {
    name: "AdminProductIndex",
    data() {
        return {
            actionModal: 'CREATE',
            CREATE: 'CREATE',
            UPDATE: 'UPDATE',
            product: {
                name: null,
                description: null,
                value: null,
                isActive: null,
                slug: null,
            },
            isBusy: false,
            currentPage: 1,
            perPage: 25,
            items: [],
            fields: [
                {key:'id'},
                {key:'name'},
                {key:'description'},
                {key:'value'},
                {key:'is_active'},
                {key:'slug'},
                {key:'actions'},
            ]
        }
    },
    methods: {
        resetProductModal() {
            this.role = {
                name: null,
                description: null,
                value: null,
                isActive: null,
                slug: null,
                id: null
            }
        },
        createItem() {
            this.actionModal = this.CREATE;
            this.product = {
                name: null,
                description: null,
                value: null,
                isActive: null,
                slug: null,
                id: null
            };
            this.$bvModal.show('modal-product');
        },
        onEdit(item) {
            this.actionModal = this.UPDATE;
            this.product.name = item.name;
            this.product.description = item.description;
            this.product.value = item.value;
            this.product.isActive = !!item.is_active;
            this.product.slug = item.slug;
            this.product.id = item.id;
            this.$bvModal.show('modal-product');
        },
        confirmDelete(item) {
            let confirmMessage = 'Are you sure?'
            this.$bvModal.msgBoxConfirm(confirmMessage)
                .then(value => {
                    if(value) {
                        this.onDelete(item)
                    }
                });
        },
        onDelete(item) {
            axios.delete('/admin/product/'+item.id)
                .then((response)=>{
                    this.getItems();
                })
        },
        getItems() {
            this.isBusy = true;
            axios.get(window.routes.product_get_items)
                .then(({data: response})=>{
                    this.items = response
                    this.isBusy = false;
                })
        }
    },
    created() {
        this.getItems();
    }
}
</script>



<template>
    <div>
        <b-row>
            <b-col cols="2">
                <b-button variant="success" @click="createItem">Add new permission</b-button>
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
                <template #cell(actions)="row">
<!--                    <b-button variant="info" size="sm" :href="'admin/permission/'+row.item.id" class="mr-1">-->
<!--                        <b-icon icon="eye"></b-icon>-->
<!--                    </b-button>-->
                    <b-button variant="warning" size="sm" @click="onEdit(row.item)" class="mr-1">
                        Edit
                    </b-button>
                    <b-button variant="danger" size="sm" @click="confirmDelete(row.item)">
                        Delete
                    </b-button>
                </template>
            </b-table>
        </div>
        <create-update-permission-modal
            :action="actionModal"
            :permission="permission"
            @updatePermission="getItems"
            @resetPermissionModal="resetPermissionModal">
        </create-update-permission-modal>
    </div>
</template>

<script>
export default {
    name: "AdminPermissionIndex",
    data() {
        return {
            actionModal: 'CREATE',
            CREATE: 'CREATE',
            UPDATE: 'UPDATE',
            permission: {
                name: null,
            },
            isBusy: false,
            currentPage: 1,
            perPage: 25,
            items: [],
            fields: [
                {key:'id'},
                {key:'name'},
                {key:'actions'},
            ]
        }
    },
    methods: {
        resetPermissionModal() {
            this.role = {
                name: null,
                id: null
            }
        },
        createItem() {
            this.actionModal = this.CREATE;
            this.permission = {
                name: null,
                id: null
            };
            this.$bvModal.show('modal-permission');
        },
        onEdit(item) {
            this.actionModal = this.UPDATE;
            this.permission.name = item.name;
            this.permission.id = item.id;
            this.$bvModal.show('modal-permission');
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
            axios.delete('/admin/permission/'+item.id)
                .then((response)=>{
                    this.getItems();
                })
        },
        getItems() {
            this.isBusy = true;
            axios.get(window.routes.permission_get_items)
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



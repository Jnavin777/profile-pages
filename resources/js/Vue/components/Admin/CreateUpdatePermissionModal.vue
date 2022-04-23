<template>
    <b-modal
        id="modal-permission"
        ref="modal"
        :title="action === CREATE ? 'Create permission' : 'Update permission #'+permission.id"
        @hidden="resetModal"
        @ok="handleOk"
    >
        <form ref="form" @submit.stop.prevent="handleSubmit">
            <b-form-group
                label="Name"
                label-for="name-input">
                <b-form-input
                    id="name-input"
                    v-model="permission.name"
                    required
                ></b-form-input>
            </b-form-group>
        </form>
    </b-modal>
</template>

<script>
export default {
    name: "CreateUpdatePermissionModal",
    props: ['action', 'permission'],
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
                axios.post(window.routes.permission_store, this.permission)
                    .then((response)=>{
                        self.$emit('updatePermission')
                    });
            } else if(this.action === this.UPDATE) {
                axios.put('/admin/permission/'+this.permission.id, this.permission)
                    .then((response)=>{
                        self.$emit('updatePermission')
                    })
            }
        },
        resetModal(){
            this.$emit('resetPermissionModal')
        }
    },
    created() {
        this.resetModal();
    }
}
</script>

<script setup>
import { onMounted, ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import PrimaryButton from '../PrimaryButton.vue';
import Modal from '../Modal.vue';
import InputLabel from '../InputLabel.vue';
import TextInput from '../TextInput.vue';
import DangerButton from '../DangerButton.vue';
import InputErrorArray from '../InputErrorArray.vue';
import IconClose from '../icons/IconClose.vue';
import IconEdit from '../icons/IconEdit.vue';
import IconDel from '../icons/IconDel.vue';

const engines = ref();
const showAddForm = ref(false);
const showDeleteModal = ref(false);
const form = useForm({
    name: null,
    hp: null,
    moment: null,
});
const deleteID = ref(null);
const editID = ref(null);
const filter = ref(null);

onMounted (() => getList());


const getList = () => {
    axios.get(route('engine.index')).then((data) => {
        engines.value = data.data;
    });
}

const closeCreateModal = () => {
    showAddForm.value = false;
    form.reset();
    form.clearErrors();
    editID.value = null;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    deleteID.value = null;
};

const preDelete = (id) => {
    showDeleteModal.value = true
    deleteID.value = id;
}

const submit = () => {
    if(editID.value) {
        updateItem;
    } else {
        axios.post(route('engine.store'), form.data())
        .then((data) => {
            getList();
            closeCreateModal();
        })
        .catch((errors) => {
            form.errors = errors.response.data.errors;
        });
    }
};

const deleteItem = () => {
    axios.delete(route('engine.destroy', deleteID.value))
        .then((data) => {
            deleteID.value = null;
            getList();
            closeDeleteModal();
        });
}

const preEdit = (engine) => {
    showAddForm.value = true
    editID.value = engine.id;
    form.name = engine.name;
    form.hp = engine.hp;
    form.moment = engine.moment;
}

const updateItem = () => {
    axios.put(route('engine.update', editID.value), form.data())
        .then((data) => {
            editID.value = null;
            getList();
            closeCreateModal();
        })
        .catch((errors) => {
            form.errors = errors.response.data.errors;
        });
}

const checkFilter = () => {
    if(filter.value && filter.value.length > 1) {
        axios.get(route('engine.filter', { "filter": filter.value }))
            .then((data) => {
                engines.value = data.data;
            });
    } else {
        getList();
    }
}

const clearFilter = () => {
    if(filter.value) {
        filter.value = null;
        getList();
    }
}

watch(filter, checkFilter);

</script>

<template>
<div class="h-full grid content-between">

    <div class="mx-auto mb-5 w-full grid grid-flow-row-dense grid-cols-4 content-center">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 col-span-3">
            Engines
        </h2>
        <div class="text-right content-center grid grid-cols-4">
            <TextInput
                id="filter"
                type="text"
                class="col-span-3 h-8 text-sm"
                v-model="filter"
                placeholder="filter"
            />
            <button @click="clearFilter">
                <IconClose width="32" height="32" />
            </button>
        </div>
    </div>

    <table class="border-collapse table-auto w-full text-sm" v-if="engines && engines.length > 0">
    <thead>
        <tr>
            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">
                Name
            </th>
            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center">
                HP
            </th>
            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-center">
                Moment
            </th>
            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-right">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="bg-white dark:bg-slate-800">
        <tr v-for="engine in engines">
            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">
                {{ engine.name }}
            </td>
            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">
                {{ engine.hp }}
            </td>
            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-center">
                {{ engine.moment }}
            </td>
            <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400 text-right">
                <button class="mr-2" @click="preEdit(engine)">
                    <IconEdit width="30" height="30" />
                </button>
                <button @click="preDelete(engine.id)">
                    <IconDel width="30" height="30" />
                </button>
            </td>
        </tr>
    </tbody>
    </table>

    <div v-else>
        No records yet...
    </div>

    <div class="pt-5 text-right">
        <PrimaryButton @click="showAddForm = true">
            Add
        </PrimaryButton>
    </div>

    <Modal :show="showDeleteModal" @close="closeDeleteModal">
        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 grid grid-flow-row-dense">
                <div class="mx-auto w-full grid grid-flow-row-dense grid-cols-2 ">
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 pb-5 text-left">
                        Delete Engine
                    </h2>
                    <div class="text-right">
                        <button @click="closeDeleteModal">
                            <IconClose width="30" height="30" />
                        </button>
                    </div>
                </div>
                <div class="mx-auto flex items-center">
                    <div class="">
                        <PrimaryButton @click="closeDeleteModal">
                            Cancel
                        </PrimaryButton>
                    </div>

                    <div class="">
                        <DangerButton
                            class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            @click="deleteItem"
                        >
                            Delete
                        </DangerButton>
                    </div>
                </div>
            </div>
        </div>
    </Modal>

    <Modal :show="showAddForm" @close="closeCreateModal">
        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 grid grid-flow-row-dense">

                <div class="mx-auto w-full grid grid-flow-row-dense grid-cols-2 ">
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200 pb-5 text-left">
                        <span v-if="editID">Update</span><span v-else>Add</span> Engine
                    </h2>
                    <div class="text-right">
                        <button @click="closeCreateModal">
                            <IconClose width="30" height="30" />
                        </button>
                    </div>
                </div>

                <form @submit.prevent="submit" @submit="updateItem">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputErrorArray class="mt-2" :messages="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="hp" value="HP" />

                        <TextInput
                            id="hp"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.hp"
                        />

                        <InputErrorArray class="mt-2" :messages="form.errors.hp" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="moment" value="Moment" />

                        <TextInput
                            id="moment"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.moment"
                        />

                        <InputErrorArray class="mt-2" :messages="form.errors.moment" />
                    </div>

                    <div class="mx-auto w-full grid grid-flow-row-dense grid-cols-2 mt-4 items-center">
                        <div class="">
                            <DangerButton @click="closeCreateModal">
                                Cancel
                            </DangerButton>
                        </div>

                        <div class="text-right">
                            <PrimaryButton
                                class="ms-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                <span v-if="editID">Update</span>
                                <span v-else>Add</span>
                            </PrimaryButton>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </Modal>

</div>
</template>

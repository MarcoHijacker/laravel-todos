<template>
    <div class="container">
        <single-checklist
          v-for="(checklist, index) in checklists"
          :key="`chk${index}`"
          :checklist="checklist"
           @upd-checklists="updTasks"
        />
    </div>
</template>

<script>
import axios from "axios";
import SingleChecklist from "./SingleChecklist.vue";
export default {
    components: { SingleChecklist },
    data() {

    },
    props: {
        loggedUser: Number
    },
    mounted() {

    },
    methods: {

    }
};
</script>

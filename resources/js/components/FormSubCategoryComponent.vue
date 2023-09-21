<template>
    <div>
        <div>
            <form action="/post/sub_category" method="post">
                <div>
                    <select name="category_id">
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category}}</option>
                    </select>
                </div>
                <label for="sub_category">中項目</label>
                <input type="text" name="sub_category" id="sub_category">
                <input type="submit" value="送信" class="btn btn-dark">
                <input type="hidden" name="_token" :value="csrf">
            </form>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            categories: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                test: true,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };
        },
        methods: {
            test() {
                return true;
            }
        }
    }

</script>
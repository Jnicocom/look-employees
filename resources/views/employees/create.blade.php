<x-app>
    <h2>New</h2>
    <form
        class="form-employee"
        id="form-employee-create">
        <x-input
            :name="'name'"
            :placeholder="'Name'"
            :required="'none'"/>

        <x-input
            :name="'surname'"
            :placeholder="'Surname'"/>

        <x-input
            :type="'date'"
            :name="'date_of_birth'"/>

        <x-input
            :name="'email'"
            :placeholder="'Email'"/>

        <x-select
            :name="'employee_role_id'">
            <option
                selected
                disabled>
                Role
            </option>
            @foreach($employeeRoles as $employeeRole)
                <option value="{{ $employeeRole->id }}">{{ $employeeRole->name }}</option>
            @endforeach
        </x-select>

        @csrf
        <x-button id="form-employee-create-button">
            Save
        </x-button>
    </form>

    <x-slot name="scripts">
        <script>
            let formEmployeeCreate = $('#form-employee-create');

            formEmployeeCreate.validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100
                    },
                    date_of_birth: {
                        required: true,
                        dateISO: true,
                        age: [18, 65]
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    employee_role_id: {
                        required: true
                    }
                },

                errorClass: 'form-error',

                submitHandler: function () {
                    $.ajax({
                        url: "{{ url('employee') }}",
                        type: 'POST',
                        data: formEmployeeCreate.serialize(),
                        success: function (response) {
                            window.location = response.redirect_to;
                        },
                        error: function (error) {
                            console.error(error.responseJSON.message)
                        }
                    });
                }
            });

            $.validator.addMethod('age', function (value, element, range) {
                let dateToday = new Date(value);
                let monthDifference = Date.now() - dateToday.getTime();
                let employeeYearOfBirth = new Date(monthDifference).getUTCFullYear();
                let age = Math.abs(employeeYearOfBirth - 1970);

                return age > range[0] && age < range[1];
            }, 'Age not between 15 and 65 years old.');
        </script>
    </x-slot>
</x-app>

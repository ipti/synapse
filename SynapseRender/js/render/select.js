$(document).ready(function () {
    var DB_synapse = new DB();

    /*
     //Classe Principal
     var getAllClassAndStudents = function () {
     DB_synapse.actorOwnUnity = new Array();
     DB_synapse.getAllClass(DB_synapse.getAllStudentFromClasses, eventFilterMeet);
     }
     
     var eventFilterMeet = function (actorOwnUnity) {
     var classrooms = actorOwnUnity;
     }
     
     if (sessionStorage.getItem('login_personage_name') === 'Tutor') {
     getAllClassAndStudents();
     } else {
     eventFilterMeet(null);
     }
     
     */



    if (sessionStorage.getItem('login_personage_name') === 'Tutor') {
        $("#login-select").show();
        $("#classroom").html("<option value='-1'>Selecione uma Turma</option>");

        DB_synapse.findAllSchools(function (listSchools) {
            //CallBack Schools
            var hClassroom = $('#classroom');
            DB_synapse.findAllClassrooms(function (listClassrooms) {
                //CallBack Classrooms
                var schools_classrooms = [];
                for (var idxSchool in listSchools) {
                    var school = listSchools[idxSchool];
                    schools_classrooms[idxSchool] = {};
                    schools_classrooms[idxSchool]['id'] = school['id'];
                    schools_classrooms[idxSchool]['name'] = school['name'];
                    schools_classrooms[idxSchool]['classrooms'] = [];

                    for (var idxClassroom in listClassrooms) {
                        var classroom = listClassrooms[idxClassroom];
                        //Relacionar todas as Turmas da Escola Corrente
                        if (school['id'] == classroom['school_id']) {
                            //Turma pertence a escola corrente
                            schools_classrooms[idxSchool]['classrooms'].push(classroom);
                        }
                    }
                }

                if (schools_classrooms.length > 0) {
                    //Encontrou pelo menos uma escola
                    var strOptionsSchoolsClassrooms = "";
                    for (var idxSchool in schools_classrooms) {
                        var school_classrooms = schools_classrooms[idxSchool];
                        for (var idxClassroom in school_classrooms['classrooms']) {
                            var classroom = school_classrooms['classrooms'][idxClassroom];
                            strOptionsSchoolsClassrooms += "<option value=" + classroom['id'] + ">"
                                    + school_classrooms['name'] + " [" + classroom['name'] + "]" + "</option>"
                        }
                    }

                    hClassroom.append(strOptionsSchoolsClassrooms);
                } else {
                    hClassroom.html("<option value='-1'>Sem Escola</option>");
                }


            });
        });

        $('#classroom').on('change', function () {
            var classroom_id = $(this).find('option:selected').val();
            DB_synapse.findStudentByClassroom(classroom_id, function (students) {
                //Adicionar os estudantes encontrados no select
                var hActor = $('#actor');
                var strOptionsActors = "";
                for (var idx in students) {
                    var student = students[idx];
                    strOptionsActors += "<option value=" + student['id'] + ">" + student['name'] + "</option>";
                }

                if (students.length > 0) {
                    //Encontrou pelo menos um aluno
                    hActor.html(strOptionsActors);
                } else {
                    hActor.html("<option value='-1'>Sem Aluno</option>");
                }

            });
        });


    } else {
        $("#login-select").hide();
        $('#select-student').hide();
        $("#select-discipline").css('margin-top', '10%');
    }

    $('.discipline').click(function () {
            //Um aluno foi selecionado
            sessionStorage.setItem('id_discipline', $(this).attr('discipline'));
            if (sessionStorage.getItem('login_personage_name') == 'Tutor') {
                //Ator
                sessionStorage.setItem('id_actor', $('#actor').val());
                sessionStorage.setItem('name_actor', $('#actor').find(":selected").text());
                
                //Turma
                sessionStorage.setItem('id_classroom', $('#classroom').val());
                sessionStorage.setItem('name_classroom', $('#classroom').find(":selected").text());
                
            }
            window.location = "./meet.html";
        
    });


    $('#toolsAdmin').on('click', function () {
        location.href = "import.html";
    });

});
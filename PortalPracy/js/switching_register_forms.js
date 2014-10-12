$(document).ready(function() {
                $('#student_reg_block').css('display', 'block');
                $('#teacher_reg_block').css('display', 'none');
                $('#company_reg_block').css('display', 'none');
                $('#student_reg_select').css('background', '#DCCB97');
                $('#student_reg_select').click(function() {
                    $('#student_reg_block').css('display', 'block');
                    $('#teacher_reg_block').css('display', 'none');
                    $('#company_reg_block').css('display', 'none');
                    $('#student_reg_select').css('background', '#DCCB97');
                    $('#teacher_reg_select').removeAttr('style');
                    $('#company_reg_select').removeAttr('style');
                });
                $('#teacher_reg_select').click(function() {
                    $('#student_reg_block').css('display', 'none');
                    $('#teacher_reg_block').css('display', 'block');
                    $('#company_reg_block').css('display', 'none');
                    $('#student_reg_select').removeAttr('style');
                    $('#teacher_reg_select').css('background', '#DCCB97');
                    $('#company_reg_select').removeAttr('style');
                });
                $('#company_reg_select').click(function() {
                    $('#student_reg_block').css('display', 'none');
                    $('#teacher_reg_block').css('display', 'none');
                    $('#company_reg_block').css('display', 'block');
                    $('#student_reg_select').removeAttr('style');
                    $('#teacher_reg_select').removeAttr('style');
                    $('#company_reg_select').css('background', '#DCCB97');
                });
            });


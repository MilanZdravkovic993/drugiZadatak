# drugiZadatak

Project does not have a routing library and all endpoints are called by targeting them in uri

Instructions

 endpoints : 


 Create:
                    
                    - createIntern localhost/drugizadatak/App/Api/createIntern.php takes POST requests and accepts JSON as body
                    example:
                    {
                        "firstName": "Milan",
                        "lastName": "Zdravkovic",
                        "group_id": "16"
                    }
                    
                    
                    - createMentor localhost/drugizadatak/App/Api/createMentor.php takes POST requests and accepts JSON as body
                    example:
                    {
                        "firstName": "Milan",
                        "lastName": "Zdravkovic",
                        "group_id": "16"
                    }
                    
                    
                    - createGroup localhost/drugizadatak/App/Api/createGroup.php takes POST requests and accepts JSON as body
                    example:
                    {
                        "name": "FrontEnd1"
                    }
                    
                    
                    - createComment localhost/drugizadatak/App/Api/createComment.php takes POST requests and accepts JSON as body
                    example:
                    {
                        "mentor_id":"1",
                        "intern_id":"2",
                        "Comment":"Comment text"
                    }
                    
                    notice: Mentor can post a comment for a intern only if they are in the same group

Read:
                    -interns localhost/drugizadatak/App/Api/interns.php takes no parameters
                    returns list od all interns as JSON array

                    -mentors localhost/drugizadatak/App/Api/mentors.php takes no parameters
                    returns list od all mentors as JSON array

                    -groups localhost/drugizadatak/App/Api/groups.php takes no parameters
                    returns list od all groups as JSON array
                    
                    -comments localhost/drugizadatak/App/Api/comments.php takes no parameters
                    returns list od all comments as JSON array

                    -singleIntern localhost/drugizadatak/App/Api/singleintern.php takes one parameter id example localhost/drugizadatak/App/Api/Singleintern.php?id=1
                    returns intern with that id and lists all comments mentors left for him

                    -singleMentor localhost/drugizadatak/App/Api/singleMentor.php takes one parameter id example localhost/drugizadatak/App/Api/singleMentor.php?id=1
                    returns mentor with that id

                    -singleGroup localhost/drugizadatak/App/Api/singleGroup.php takes one parameter id example localhost/drugizadatak/App/Api/singleGroup.php?id=1
                    returns group with that id

                    -singleComment localhost/drugizadatak/App/Api/singleComment.php takes one parameter id example localhost/drugizadatak/App/Api/singleComment.php?id=1
                    returns comment with that id
                    
                    -groupsListing localhost/drugizadatak/App/Api/groupsListing.php takes one parameter id example localhost/drugizadatak/App/Api/singleGroup.php?id=1
                    returns group with that id and all Interns and Mentors that are in that group

Update:
                    -updateIntern localhost/drugizadatak/App/Api/updateIntern.php takes PUT requests and accepts JSON as body
                     example:
                    {
                        "firstName": "Milan",
                        "lastName": "Zdravkovic",
                        "group_id": "16"
                    }
                     -updateMentor localhost/drugizadatak/App/Api/updateMentor.php takes PUT requests and accepts JSON as body
                     example:
                    {
                        "firstName": "Milan",
                        "lastName": "Zdravkovic",
                        "group_id": "16"
                    }
                     -updateGroup localhost/drugizadatak/App/Api/updateGroup.php takes PUT requests and accepts JSON as body
                     example:
                    {
                       "name": "FrontEnd1"
                    }
                     -updateComment localhost/drugizadatak/App/Api/updateComment.php takes PUT requests and accepts JSON as body
                     example:
                    {
                        "mentor_id":"1",
                        "intern_id":"2",
                        "Comment":"Comment text"
                    }
Delete:
                    -deleteIntern localhost/drugizadatak/App/Api/deleteIntern.php takes one parameter id example localhost/drugizadatak/App/Api/deleteIntern.php?id=1
                    deletes intern with that id from database

                    -deleteMentor localhost/drugizadatak/App/Api/deleteMentor.php takes one parameter id example localhost/drugizadatak/App/Api/deleteMentor.php?id=1
                    deletes mentor with that id from database

                    -deleteIntern localhost/drugizadatak/App/Api/deleteGroup.php takes one parameter id example localhost/drugizadatak/App/Api/deleteGroup.php?id=1
                    deletes group with that id from database

                    -deleteIntern localhost/drugizadatak/App/Api/deleteComment.php takes one parameter id example localhost/drugizadatak/App/Api/deleteComment.php?id=1
                    deletes comment with that id from database


In folder Database there is a sql file for creating the DB and php script for populating the DB with Interns, Mentors and Groups. On start there are no Comments
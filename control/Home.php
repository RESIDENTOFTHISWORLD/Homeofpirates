<?php

namespace homeOfPirates\Control;

class Home extends Base
{
    public $title = "Home";
    public $template = "home.php";

    public $cat = [];

//    public function getList()
//    {
//        $searchTerm = $this->getRequestParameter("searchTerm");
//        $this->cat = [];
//        $oCategory = new Category();
//        $oCategory = $oCategory->loadList();
//        foreach ($oCategory as $row) {
//            $this->cat[] = ["id" => $row->id, "name" => $row->name];
//        }
//        if (isset($_REQUEST["searchTerm"])) {
//            echo json_encode($this->cat);
//        }
//    }

//    public function getListElements()
//    {
//        $gitApi = GitApi::getInstance();
//        $repoName = $this->getRequestParameter("gitRepoName");
//        $token = $this->getToken();
//        $collaboratorsArray = $gitApi->getRepoCollaboratorsForToken($repoName, $token);
//        $collaboratorsArray = json_decode($collaboratorsArray);
//        if (isset($collaboratorsArray->message) && $collaboratorsArray->message == "Must have manager rights to Repository.") {
//            echo "error";
//        } else {
//            $manager = $this->getAndSetAdmin($token);
//            $mitarbeiter = new Mitarbeiter();
//            $mitarbeiterArray = $mitarbeiter->loadList("admin_id = '" . $manager->id . "'");
//
//            $colaborators = "";
//            $notColaboratorsArray = [];
//
//            $invitedArray = json_decode($gitApi->getRepoInvitationsForToken($repoName, $token));
//            $invites = "";
//            foreach ($invitedArray as $invite) {
//                $mitarbeiterName = $this->checkUsernameDatabase($mitarbeiterArray, $invite->invitee->login);
//                if (!empty($invite->expired)) {
//                    $invites .= '<button style="background: red; color: white;" type="button" value="' . $invite->id . '" onclick="manageListBtns(event,this,\'' . $invite->id . '\',\'' . $mitarbeiterName . '\',\'removeInviteExpired\')" class="INREPOEXPIRED list-group-item list-group-item-action"><p class="float-right">&#9993;</p>' . $mitarbeiterName . '</button>';
//                } else {
//                    $invites .= '<button style="background: #ffcc00" type="button" value="' . $invite->id . '" onclick="manageListBtns(event,this,\'' . $invite->id . '\',\'' . $mitarbeiterName . '\',\'removeInvite\')" class="INREPO list-group-item list-group-item-action"><p class="float-right">&#9993;</p>' . $mitarbeiterName . '</button>';
//                }
//                $notColaboratorsArray[] = $invite->invitee->login;
//            }
//
//            foreach ($collaboratorsArray as $collaborator) {
//                $notColaboratorsArray[] = $collaborator->login;
//                $mitarbeiterName = null;
//                $mitarbeiterUsername = $collaborator->login;
//                foreach ($mitarbeiterArray as $mitarbeiterRow) {
//                    if ($mitarbeiterRow->username == $mitarbeiterUsername) {
//                        $mitarbeiterName = $mitarbeiterRow->name;
//                    }
//                }
//                if ($mitarbeiterName === null) {
//                    $mitarbeiterName = $mitarbeiterUsername;
//                }
//
//                if (strpos($repoName, $collaborator->login) !== 0) {
//                    $colaborators .= '<button type="button" value="' . $mitarbeiterUsername . '" onclick="manageListBtns(event,this,\'' . $mitarbeiterUsername . '\',\'' . $mitarbeiterName . '\',\'remove\')" class="INREPO list-group-item list-group-item-action"><p class="float-right">&#10134;</p>' . $mitarbeiterName . '</button>';
//                }
//
//            }
//            $notColaborators = "";
//            foreach ($mitarbeiterArray as $row) {
//                if (!in_array($row->username, $notColaboratorsArray)) {
//                    $notColaborators .= '<button type="button" value="' . $row->username . '" onclick="manageListBtns(event,this,\'' . $row->username . '\',\'' . $row->name . '\',\'add\')" class="NOTINREPO list-group-item list-group-item-action"><p class="float-left">&#10133;</p>' . $row->name . '</button>';
//                }
//            }
//            echo json_encode(["INREPO" => $colaborators, "NOTINREPO" => $notColaborators, "INVITED" => $invites]);
//        }
//    }


//    public function saveConfiguration()
//    {
//        $gitApi = GitApi::getInstance();
//        $token = $this->getToken();
//        $repoName = $this->getRequestParameter("gitRepoName");
//        $collaborators = json_decode($gitApi->getRepoCollaboratorsForToken($repoName, $token));
//        $invites = json_decode($gitApi->getRepoInvitationsForToken($repoName, $token));
//
//        $oldRepoCon = [];
//        foreach ($collaborators as $collaborator) {
//            $oldRepoCon [] = $collaborator->login;
//        }
//        $inviteIdArray = [];
//        foreach ($invites as $invite) {
//            $oldRepoCon [] = $invite->invitee->login;
//            $inviteIdArray[] = $invite->id;
//        }
//        $newRepoCon = $this->getRequestParameter("newRepoCon");  // [addToRepo] == TO ADD USERS, [removeFromRepo] == TO REMOVE USERS [resentInvites] == TO DELETE INVITE AND RESEND
//
//        $addToRepo = (!empty($newRepoCon["addToRepo"])) ? $newRepoCon["addToRepo"] : null;
//        if ($addToRepo !== null) {
//            $addToRepo = $this->removeInjectablesFromStrings($addToRepo);
//            $addToRepo = $this->removeAlreadyInRepo($addToRepo, $oldRepoCon, $repoName);
//            foreach ($addToRepo as $username) {
//                $gitApi->addUserToRepo($repoName, $username, $token);
//            }
//        }
//
//        $removeFromRepo = (!empty($newRepoCon["removeFromRepo"])) ? $newRepoCon["removeFromRepo"] : null;
//        if ($removeFromRepo !== null) {
//            $removeFromRepo = $this->removeInjectablesFromStrings($removeFromRepo);
//
//            $checkedArray = $this->removeSendInvites($removeFromRepo, $inviteIdArray);
//
//            $removeFromRepo = $this->removeAlreadyRemoved($checkedArray["users"], $oldRepoCon, $repoName);
//            foreach ($removeFromRepo as $username) {
//                $gitApi->removeUserFromRepo($repoName, $username, $token);
//            }
//            foreach ($checkedArray["invites"] as $inviteId) {
//                $gitApi->deleteInvitationFromRepo($repoName, $inviteId, $token);
//            }
//        }
//
//        $resentInvites = (!empty($newRepoCon["resentInvites"])) ? $newRepoCon["resentInvites"] : null;
//        if ($resentInvites !== null) {
//            $resentInvites = $this->removeInjectablesFromStrings($resentInvites);
//            $usernames = [];
//            foreach ($invites as $invite) {
//                if(!empty($invite->expired)){
//                   $usernames[] =  $invite->invitee->login;
//                }
//            }
//            foreach ($resentInvites as $inviteId) {
//                $gitApi->deleteInvitationFromRepo($repoName, $inviteId, $token);
//            }
//            foreach ($usernames as $username) {
//                $gitApi->addUserToRepo($repoName, $username, $token);
//            }
//        }
//        echo "Success";
//    }
}

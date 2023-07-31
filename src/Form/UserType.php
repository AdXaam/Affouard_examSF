<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
                'label' =>'Adresse mail',
                'attr' =>['class'=>'form-control input-field m-2'],
                ])
            ->add('password',PasswordType::class,[
                'label'=>'Mot de passe',
                'mapped'=>false,
                'attr'=>[
                    'autocomplete'=>'new-password',
                    'class'=>'form-control input-field m-2'

                ],
                'constraints'=>[
                    new NotBlank([
                        'message'=>'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        "min"=>8,
                        'minMessage'=>'Votre mot de passe doit faire au moins 8 caractères',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern'=>'/(?=\S*[a-z])(?=\S*\d)/',
                        'message'=>'Votre mot de passe doit avoir au moins 1 chiffre et 1 lettre majuscule',
                    ])
                ]
            ])
            ->add('firstname',TextType::class,[
                'attr'=>[
                    'label'=>'Prenom',
                    'class'=>'form-control input-field m-2'
                ]
            ])
            ->add('lastname',TextType::class,[
                'label'=>'Nom de famille',
                'attr'=>[
                    'class'=>'form-control input-field m-2'
                ]
            ])
            ->add('picture',FileType::class,[
                'attr'=>[
                    'class'=>'form-control input-field m-2'
                ],
                'label'=>'Image',
                'mapped'=>false,
                'required'=>false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Uniquement les formats JPG et PNG !',
                    ])
                ],
            ])
            ->add('sector', ChoiceType::class, [
                'label' => 'Secteur',
                'attr'=>[
                    'class'=>'form-control input-field m-2'
                ],
                'choices' => [
                    'Informatique' => 'Informatique',
                    'Comptabilité' => 'Comptabilité',
                    'Direction' => 'Direction',
                ],
            ])
            ->add('contract', ChoiceType::class, [
                'label' => 'Contrat',
                'attr'=>[
                    'class'=>'form-control input-field m-2'
                ],
                'choices' => [
                    'CDI' => 'CDI',
                    'CDD' => 'CDD',
                    'Interim' => 'Interim',
                ],
            ])

            ->add('date', null, [
                'attr'=>[
                    'class'=>'form-control m-2'
                ],
                'label' => 'Date de fin de contrat',
            ])
            ->add('Valider', SubmitType::class, [
                "attr" => [
                    "class" => "btn btn-success"
                ]
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

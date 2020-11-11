<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

use App\Entity\Task;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task', null ,[    //symfony guessing mechanism by validation constraints
                'attr' => ['class' => 'form-control'],
                'required' => true,
            ])
            ->add('dueDate', DateType::class, [
                'required' => $options['require_due_date'],
                ])
            ->add('agreeTerms', CheckboxType::class, ['mapped' => false])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
            'require_due_date' => false,
        ]);
        $resolver->setAllowedTypes('require_due_date', 'bool');
    }
}
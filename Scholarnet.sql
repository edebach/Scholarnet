PGDMP     ,    $    
            {        
   Scholarnet    15.2    15.2                 0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            !           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            "           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            #           1262    65655 
   Scholarnet    DATABASE        CREATE DATABASE "Scholarnet" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Italian_Italy.1252';
    DROP DATABASE "Scholarnet";
                postgres    false            �            1259    65656    compito    TABLE     h  CREATE TABLE public.compito (
    classe character varying(8) NOT NULL,
    titolo character varying(255) NOT NULL,
    testo text NOT NULL,
    allegati character varying(255),
    utente character varying(255) NOT NULL,
    data_scadenza date,
    ora time without time zone,
    pubblicazione timestamp without time zone,
    email character varying(50)
);
    DROP TABLE public.compito;
       public         heap    postgres    false            �            1259    65661    corso    TABLE     �   CREATE TABLE public.corso (
    codice character varying(8) NOT NULL,
    nome character varying(50) NOT NULL,
    materia character varying(50),
    link character varying(150) NOT NULL,
    link_imm character varying(150) NOT NULL
);
    DROP TABLE public.corso;
       public         heap    postgres    false            �            1259    65664    insegna    TABLE     v   CREATE TABLE public.insegna (
    docente character varying(50) NOT NULL,
    corso character varying(50) NOT NULL
);
    DROP TABLE public.insegna;
       public         heap    postgres    false            �            1259    65667 	   partecipa    TABLE     y   CREATE TABLE public.partecipa (
    studente character varying(50) NOT NULL,
    corso character varying(50) NOT NULL
);
    DROP TABLE public.partecipa;
       public         heap    postgres    false            �            1259    65670 
   recensione    TABLE       CREATE TABLE public.recensione (
    utente character varying(50) NOT NULL,
    data timestamp without time zone NOT NULL,
    stelle character varying(5) NOT NULL,
    descrizione character varying(250) DEFAULT NULL::character varying,
    nome_recensione character varying(100)
);
    DROP TABLE public.recensione;
       public         heap    postgres    false            �            1259    65674    utente    TABLE     �  CREATE TABLE public.utente (
    nome character varying(30) NOT NULL,
    cognome character varying(30) NOT NULL,
    email character varying(50) NOT NULL,
    pass character varying(100) NOT NULL,
    istituto character varying(50),
    sesso character varying(10) NOT NULL,
    "dataN" date NOT NULL,
    "flagStudente" boolean,
    telefono character varying(20) DEFAULT ''::character varying NOT NULL,
    data_iscrizione date
);
    DROP TABLE public.utente;
       public         heap    postgres    false                      0    65656    compito 
   TABLE DATA           t   COPY public.compito (classe, titolo, testo, allegati, utente, data_scadenza, ora, pubblicazione, email) FROM stdin;
    public          postgres    false    214   �!                 0    65661    corso 
   TABLE DATA           F   COPY public.corso (codice, nome, materia, link, link_imm) FROM stdin;
    public          postgres    false    215   �!                 0    65664    insegna 
   TABLE DATA           1   COPY public.insegna (docente, corso) FROM stdin;
    public          postgres    false    216   �!                 0    65667 	   partecipa 
   TABLE DATA           4   COPY public.partecipa (studente, corso) FROM stdin;
    public          postgres    false    217   "                 0    65670 
   recensione 
   TABLE DATA           X   COPY public.recensione (utente, data, stelle, descrizione, nome_recensione) FROM stdin;
    public          postgres    false    218   3"                 0    65674    utente 
   TABLE DATA           �   COPY public.utente (nome, cognome, email, pass, istituto, sesso, "dataN", "flagStudente", telefono, data_iscrizione) FROM stdin;
    public          postgres    false    219   �"       {           2606    65679    corso corso_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.corso
    ADD CONSTRAINT corso_pkey PRIMARY KEY (codice);
 :   ALTER TABLE ONLY public.corso DROP CONSTRAINT corso_pkey;
       public            postgres    false    215                       2606    65681    partecipa pk_partecipa 
   CONSTRAINT     a   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT pk_partecipa PRIMARY KEY (studente, corso);
 @   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT pk_partecipa;
       public            postgres    false    217    217            �           2606    65683    recensione pk_recensione 
   CONSTRAINT     `   ALTER TABLE ONLY public.recensione
    ADD CONSTRAINT pk_recensione PRIMARY KEY (utente, data);
 B   ALTER TABLE ONLY public.recensione DROP CONSTRAINT pk_recensione;
       public            postgres    false    218    218            }           2606    65685    insegna primary_key 
   CONSTRAINT     ]   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT primary_key PRIMARY KEY (docente, corso);
 =   ALTER TABLE ONLY public.insegna DROP CONSTRAINT primary_key;
       public            postgres    false    216    216            �           2606    65687    utente utente_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.utente
    ADD CONSTRAINT utente_pkey PRIMARY KEY (email);
 <   ALTER TABLE ONLY public.utente DROP CONSTRAINT utente_pkey;
       public            postgres    false    219            �           2606    65688    compito compito_classe_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.compito
    ADD CONSTRAINT compito_classe_fkey FOREIGN KEY (classe) REFERENCES public.corso(codice) ON UPDATE CASCADE ON DELETE CASCADE;
 E   ALTER TABLE ONLY public.compito DROP CONSTRAINT compito_classe_fkey;
       public          postgres    false    215    214    3195            �           2606    65693    partecipa fk_corso    FK CONSTRAINT     �   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT fk_corso FOREIGN KEY (corso) REFERENCES public.corso(codice) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 <   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT fk_corso;
       public          postgres    false    3195    215    217            �           2606    65698    insegna fk_corso    FK CONSTRAINT     �   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT fk_corso FOREIGN KEY (corso) REFERENCES public.corso(codice) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 :   ALTER TABLE ONLY public.insegna DROP CONSTRAINT fk_corso;
       public          postgres    false    216    215    3195            �           2606    65703    insegna fk_docente    FK CONSTRAINT     �   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT fk_docente FOREIGN KEY (docente) REFERENCES public.utente(email) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 <   ALTER TABLE ONLY public.insegna DROP CONSTRAINT fk_docente;
       public          postgres    false    216    219    3203            �           2606    65708    partecipa fk_studente    FK CONSTRAINT     �   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT fk_studente FOREIGN KEY (studente) REFERENCES public.utente(email) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 ?   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT fk_studente;
       public          postgres    false    219    217    3203            �           2606    65715    recensione utente_recens_fk    FK CONSTRAINT     �   ALTER TABLE ONLY public.recensione
    ADD CONSTRAINT utente_recens_fk FOREIGN KEY (utente) REFERENCES public.utente(email) NOT VALID;
 E   ALTER TABLE ONLY public.recensione DROP CONSTRAINT utente_recens_fk;
       public          postgres    false    219    218    3203                  x������ � �            x������ � �            x������ � �            x������ � �         U   x��;
�  �ٜ�(~�N��%�(�E�?}�۫Y�x��<,\��e����T|PY�,8&�!U�Sڌ�J[{��� ��d�         �   x�}�;�0��)��-�A
D�hi6�V�qd\qz��7[̎���	�1����b|�n�1"]�O�6�:�La�#8��%�R*��-`l�U�n��wm�l�4�a)�pL}ȅꛊ]N}�&T�������9�vn�!⫴�<a�*-W��~d��c�2�L     